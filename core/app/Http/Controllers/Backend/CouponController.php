<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $allData = Coupon::latest()->get();
        return view('backend.coupons.index', compact('allData'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_code' => 'required|unique:coupons',
            'min_purchase' => 'required',
            'max_discount' => 'required',
            'start_date' => 'required',
        ]);
        try{
            $input = $request->except('_token');
            $input['start_date'] = date('Y-m-d',strtotime($request->start_date));
            if($request->end_date!=''){
                $input['end_date'] = date('Y-m-d',strtotime($request->end_date));
            }
            Coupon::create($input);
            return back()->with('success', 'Data created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_code' => "required|unique:coupons,coupon_code,$id",
            'min_purchase' => 'required',
            'max_discount' => 'required',
            'start_date' => 'required',
        ]);

        try {
            $data = Coupon::findOrFail($id);
            $input = $request->except(['_token', '_method']);
            $input['start_date'] = date('Y-m-d',strtotime($request->start_date));
            if($request->end_date!=''){
                $input['end_date'] = date('Y-m-d',strtotime($request->end_date));
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
    public function destroy($id)
    {
        try {
            $data = Coupon::findOrFail($id);
            $data->delete();
            return back()->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
