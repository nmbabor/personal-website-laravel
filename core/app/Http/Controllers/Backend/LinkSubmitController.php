<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LinkSubmit;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Validator;

class LinkSubmitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = LinkSubmit::where('user_id',auth()->user()->id)->latest();
    
            return DataTables::of($allData)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex','')
                ->editColumn('status', function ($data) {
                    if($data->status == 1){
                        return "<span class='badge bg-success'>Done</span>";
                    }else{
                        return "<span class='badge bg-danger'>Not Done</span>";
                    }
                })
                ->addColumn('created', function ($data) {
                    return date('d M, Y', strtotime($data->created_at));
                })
                ->addColumn(
                    'action',
                    '<div class="action-wrapper">
                    <a class="btn btn-xs bg-gradient-success"
                        href="{{ route(\'link-submit.show\', $id) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                        <a class="btn btn-danger btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Data"
                            href="javascript:void(0)"
                            onclick=\'resourceDelete("{{ route(\'link-submit.destroy\', $id) }}")\'>
                            <span class="delete-icon">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        
                    </div>'
                )
                ->rawColumns(['status', 'created', 'action'])
                ->toJson();
        }
        
        return view('backend.link-submit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(auth()->user()->credits_balance < readConfig('link_credit')){
            return redirect()->back()->with('error',"You don't have sufficient credits!");
        }
        $latestData = LinkSubmit::where('user_id',auth()->user()->id)->latest()->take(5)->get();
        return view('backend.link-submit.create',compact('latestData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(auth()->user()->credits_balance < readConfig('link_credit')){
            return redirect()->back()->with('error',"You don't have sufficient credits!");
        }
        $request->validate([
            'title' => 'required',
            "links" => "required",
        ]);
        try{
             $lines = explode("\r\n", $request->links);
            $total_lines = count($lines);
            $totalCredit = $total_lines * readConfig('link_credit');
            
            $url = "https://app.sinbyte.com/api/indexing/";

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, [
                'apikey' => env('SINBYTE_API_KEY'),
                'name' => $request->title,
                'dripfeed' => 1,
                'method' => 'tools',
                'urls' => $lines,
            ]);
            // Check if the response status code is in the 2xx range (success)
            if ($response->successful()) {
              LinkSubmit::create([
                    'title'=>$request->title,
                    'links'=> json_encode($lines),
                    'total_links'=>$total_lines,
                    'total_credits'=>$totalCredit,
                    'user_id'=>auth()->user()->id,
                    'status' => 1
                ]);
                User::where('id',auth()->user()->id)->update([
                    'credits_balance' => auth()->user()->credits_balance - $totalCredit,
                    'link_submit_balance' => auth()->user()->link_submit_balance - $total_lines,
                ]);
                return back()->with('success', 'Link Successfully submited');
            } else {
                // Error response handling
                // $errorResponseData = $response->json(); // Convert error response to JSON
                return back()->with('error', "Something Error Found");
            }
            return back()->with('success', 'Link Successfully submited');
        }catch (RequestException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = LinkSubmit::where(['user_id'=>auth()->user()->id,'id'=>$id])->firstOrFail();
        $links = implode("\r\n",json_decode($data->links));
        return view('backend.link-submit.show',compact('data','links'));
    }

    public function destroy(string $id)
    {
        try {
            $data = LinkSubmit::where(['user_id'=>auth()->user()->id,'id'=>$id])->firstOrFail();
            $data->delete();
            return back()->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function linkCheckForm (){
        $latestData = LinkSubmit::where('user_id',auth()->user()->id)->latest()->take(5)->get();
        return view('backend.link-submit.check',compact('latestData'));
    }
    public function linkCheck(Request $request){
        $validator = Validator::make($request->all(),[
            "url" => "required | url",
        ]);
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try{
            $result = indexCheck($request->url);
            return response()->json($result,200);
       }catch (RequestException $e) {
        return response()->json($e->getMessage(),406);
       }
    }
}
