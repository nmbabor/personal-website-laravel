<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $allData = Testimonial::get();
        return view('backend.testimonials.index',compact('allData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'description' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg|max:1024',
        ]);
        try{
            $input = $request->except('_token');
            if ($request->hasFile("icon")) {
                $input['icon'] = uploadImage($request->file("icon"), "/assets/images/testimonials");
            }
            Testimonial::create($input);
            return back()->with('success', 'Data created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'description' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg|max:1024',
        ]);

        try {
            $data = Testimonial::findOrFail($id);
            $input = $request->except(['_token', '_method']);
            if ($request->hasFile("icon")) {
                secureUnlink($data->icon);
                $input['icon'] = uploadImage($request->file("icon"), "/assets/images/testimonials");
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
            $data = Testimonial::findOrFail($id);
            secureUnlink($data->icon);
            $data->delete();
            return back()->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
