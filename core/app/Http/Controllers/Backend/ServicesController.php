<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = Services::latest();
    
            return DataTables::of($allData)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex','')
                ->editColumn('status', function ($data) {
                    if($data->status == 1){
                        return "<span class='badge bg-success'>Active</span>";
                    }else{
                        return "<span class='badge bg-danger'>inactive</span>";
                    }
                })
                ->addColumn('created', function ($data) {
                    return date('d M, Y', strtotime($data->created_at));
                })
                ->addColumn(
                    'action',
                    '<div class="action-wrapper">
                    <a class="btn btn-xs bg-gradient-success"
                        href="{{ url(\'services\', $slug) }}" target="_blank">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-xs bg-gradient-primary"
                        href="{{ route(\'services.edit\', $id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Category"
                                        href="javascript:void(0)"
                                        onclick=\'resourceDelete("{{ route(\'services.destroy\', $id) }}")\'>
                                        <span class="delete-icon">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    
                </div>'
                )
                ->rawColumns(['status', 'created', 'action'])
                ->toJson();
        }
        
        return view('backend.services.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            "slug" => "required|unique:technologies,slug",
            'meta_description' => 'required',
            'description' => 'required',
        ]);
        try{
            $input = $request->except('_token');
            $input['slug'] = Str::slug($request->slug);
            $input['status'] = $request->status ? 1 : 0;
            $input['created_by'] = Auth::user()->id;
            if ($request->hasFile("icon")) {
                $input['icon'] = uploadImage($request->file("icon"), "/assets/images/services");
            }
            Services::create($input);
            return back()->with('success', 'Data created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Services::findOrFail($id);
        return view('backend.services.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            "slug" => "required|unique:technologies,slug,$id",
            'meta_description' => 'required',
            'description' => 'required',
        ]);

        try {
            $data = Services::findOrFail($id);
            $input = $request->except(['_token', '_method']);
            $input['slug'] = Str::slug($request->slug);
            $input['status'] = $request->status ? 1 : 0;
            if ($request->hasFile("icon")) {
                secureUnlink($data->icon);
                $input['icon'] = uploadImage($request->file("icon"), "/assets/images/services");
            }
            $data->update($input);
            return back()->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Services::findOrFail($id);
            secureUnlink($data->icon);
            $data->delete();
            return back()->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
