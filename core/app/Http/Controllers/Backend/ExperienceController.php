<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $allData = Experience::get();
        return view('backend.resume.experience', compact('allData'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'designation' => 'required',
            'company' => 'required',
            'time_period' => 'required',
        ]);
        try{
            $input = $request->except('_token');
            Experience::create($input);
            return back()->with('success', 'Data created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'designation' => 'required',
            'company' => 'required',
            'time_period' => 'required',
        ]);

        try {
            $data = Experience::findOrFail($id);
            $input = $request->except(['_token', '_method']);
            
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
            $data = Experience::findOrFail($id);
            $data->delete();
            return back()->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
