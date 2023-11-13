<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function transections(Request $request)
    {
        if ($request->ajax()) {
            $allData = Order::with(['plan','user'])->latest();
    
            return DataTables::of($allData)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex','')
                ->addColumn('plan_name',function($data){
                    return $data->plan->title;
                })
                ->addColumn('user_email',function($data){
                    return $data->user->email ?? '';
                })
                ->addColumn('amount',function($data){
                    return ($data->plan->currency == 'usd' ? '$' : '৳') . $data->total_amount;
                })
                ->editColumn('status', function ($data) {
                    if($data->is_paid == 1){
                        return "<span class='badge bg-success'>Success</span>";
                    }else{
                        return "<span class='badge bg-warning'>Pending</span>";
                    }
                })
                ->addColumn('created', function ($data) {
                    return date('d M, Y', strtotime($data->created_at));
                })
                ->addColumn(
                    'action',
                    '<div class="action-wrapper">
                    <a class="btn btn-xs bg-gradient-success"
                        href="{{ route(\'admin.transections.show\', $id) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                        
                    </div>'
                )
                ->rawColumns(['status', 'created', 'action'])
                ->toJson();
        }
        
        return view('backend.orders.transections');
    }

    public function transectionsDetails($id){
        $data = Order::findOrFail($id);
        return view('backend.orders.transectionDetails',compact('data'));
    }
    public function approval($id){
        $data = Order::findOrFail($id);
       if($data->is_paid == 0){
        $user = User::findOrFail($data->user_id);
        $user->update([
            'credits_balance' => $user->credits_balance + $data->credits,
            'link_submit_balance' => $user->link_submit_balance + $data->link_submit
        ]);
        $data->update([
            'is_paid'=>1,
            'verified_by' => auth()->user()->id
        ]);
       }
       return redirect()->back()->with('success','Payment approved successfully');
    }
}
