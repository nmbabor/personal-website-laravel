<?php

namespace App\Http\Controllers\Backend\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioFeature;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function index(string $id)
    {
        $data = Portfolio::findOrFail($id);
        return view('backend.portfolio.features', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'portfolio_id' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);
        try{
            $input = $request->except('_token');
            if ($request->hasFile("icon")) {
                $input['icon'] = uploadImage($request->file("icon"), "/assets/images/portfolio/".$request->portfolio_id.'/features');
            }
            PortfolioFeature::create($input);
            return back()->with('success', 'Data created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'portfolio_id' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg|max:1024',
        ]);

        try {
            $data = PortfolioFeature::findOrFail($id);
            $input = $request->except(['_token', '_method']);
            if ($request->hasFile("icon")) {
                secureUnlink($data->icon);
                $input['icon'] = uploadImage($request->file("icon"), "/assets/images/portfolio/".$request->portfolio_id.'/features');
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
            $data = PortfolioFeature::findOrFail($id);
            secureUnlink($data->icon);
            $data->delete();
            return back()->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
