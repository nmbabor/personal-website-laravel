<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PricingPlanController extends Controller
{
    public function index()
    {
        $allData = PricingPlan::orderBy('serial_num','ASC')->get();
        return view('backend.pricingPlan.index', compact('allData'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'credits' => 'required',
            'link_submit' => 'required',
        ]);
        try{
            $input = $request->except('_token');
            PricingPlan::create($input);
            return back()->with('success', 'Data created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'credits' => 'required',
            'link_submit' => 'required',
        ]);

        try {
            $data = PricingPlan::findOrFail($id);
            $input = $request->except(['_token', '_method']);
            
            $data->update($input);
            return back()->with('success', 'Data updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function serialUpdate(Request $request)
    {
        
        try {
            foreach($request->position as $i => $id){
                PricingPlan::where('id',$id)->update(['serial_num'=>$i]);
            }
            return response()->json('Serial updated successfully',200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(),403);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = PricingPlan::findOrFail($id);
            $data->delete();
            return back()->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
