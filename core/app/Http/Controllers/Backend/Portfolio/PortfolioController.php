<?php

namespace App\Http\Controllers\Backend\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioImage;
use App\Models\PortfolioTechnology;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = Portfolio::latest();

            return DataTables::of($allData)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', '')
                ->editColumn('status', function ($data) {
                    if ($data->status == 1) {
                        return "<span class='badge bg-success'>Active</span>";
                    } else {
                        return "<span class='badge bg-danger'>inactive</span>";
                    }
                })
                ->addColumn('created', function ($data) {
                    return date('d M, Y', strtotime($data->created_at));
                })
                ->addColumn(
                    'action',
                    '<div class="action-wrapper">
                    <a class="btn btn-xs bg-gradient-success" title="Details Show"
                        href="{{ url(\'portfolio\', $slug) }}" target="_blank">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-xs btn-primary" title="Images"
                        href="{{ route(\'portfolio.projects.show\', $id) }}">
                        <i class="fa fa-camera"></i>
                    </a>
                    <a class="btn btn-xs btn-success" title="Features"
                        href="{{ route(\'portfolio.features.index\', $id) }}">
                        <i class="fas fa-file"></i>
                    </a>
                    <a class="btn btn-xs bg-gradient-primary"
                        href="{{ route(\'portfolio.projects.edit\', $id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Category"
                        href="javascript:void(0)"
                        onclick=\'resourceDelete("{{ route(\'portfolio.projects.destroy\', $id) }}")\'>
                        <span class="delete-icon">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    
                </div>'
                )
                ->rawColumns(['status', 'created', 'action'])
                ->toJson();
        }

        return view('backend.portfolio.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = PortfolioCategory::where('status', 1)->pluck('title', 'id');
        $technologies = Technology::where('status', 1)->pluck('title', 'id');
        return view('backend.portfolio.create', compact('categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            "slug" => "required|unique:portfolios,slug",
            'meta_description' => 'required',
            'description' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'portfolio_category_id' => 'required',
        ]);
        try {
            $input = $request->except('_token', 'technologies');
            $input['slug'] = Str::slug($request->slug);
            $input['status'] = $request->status ? 1 : 0;
            $input['created_by'] = Auth::user()->id;
            if ($request->hasFile("thumbnail")) {
                $input['thumbnail'] = uploadImage($request->file("thumbnail"), "/assets/images/portfolio");
            }
            $portfolioId = Portfolio::create($input)->id;
            if (isset($request->technologies) && count($request->technologies) > 0) {
                foreach ($request->technologies as $tech) {
                    PortfolioTechnology::create([
                        'portfolio_id' => $portfolioId,
                        'technology_id' => $tech,
                    ]);
                }
            }
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
        $data = Portfolio::findOrFail($id);
        return view('backend.portfolio.image', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Portfolio::findOrFail($id);
        $categories = PortfolioCategory::where('status', 1)->pluck('title', 'id');
        $technologies = Technology::where('status', 1)->pluck('title', 'id');
        return view('backend.portfolio.edit', compact('data', 'categories', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            "slug" => "required|unique:portfolios,slug,$id",
            'meta_description' => 'required',
            'description' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048',
            'portfolio_category_id' => 'required',
        ]);

        try {
            $data = Portfolio::findOrFail($id);
            $input = $request->except(['_token', '_method','technologies']);
            $input['slug'] = Str::slug($request->slug);
            $input['status'] = $request->status ? 1 : 0;
            if ($request->hasFile("thumbnail")) {
                secureUnlink($data->thumbnail);
                $input['thumbnail'] = uploadImage($request->file("thumbnail"), "/assets/images/portfolio");
            }
            $data->update($input);

            // Technology update
            $selectedTechnologyIds = $request->technologies;
            $currentTechnologyIds = $data->getTechnologiesId();

            // Identify the IDs to be added and removed
            $idsToAdd = array_diff($selectedTechnologyIds, $currentTechnologyIds);
            $idsToRemove = array_diff($currentTechnologyIds, $selectedTechnologyIds);

          /*   print_r($idsToAdd);
            return $idsToRemove; */

            // Add new technologies
            foreach ($idsToAdd as $technologyId) {
                PortfolioTechnology::create([
                    'portfolio_id' => $data->id,
                    'technology_id' => $technologyId,
                ]);
            }

            // Remove technologies
            foreach ($idsToRemove as $rmTechnologyId) {
                PortfolioTechnology::where(['technology_id'=> $rmTechnologyId,'portfolio_id'=>  $data->id])->delete();
            }


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
            $data = Portfolio::findOrFail($id);
            secureUnlink($data->thumbnail);
            $data->delete();
            return back()->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    

    // Portfolio Project Image store
    public function imageStore(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'portfolio_id' => 'required',
        ]);
        try {
          
            if ($request->hasFile("thumbnail")) {
                $imagePath = uploadImage($request->file("thumbnail"), "/assets/images/portfolio/".$request->portfolio_id);
            }
            PortfolioImage::create([
                'portfolio_id' => $request->portfolio_id,
                'image_path' => $imagePath,
                'status' => $request->status? 1 : 0
            ]);
            return back()->with('success', 'Data created successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function imageStatusUpdate(Request $request)
    {
        try {
            $data = PortfolioImage::findOrFail($request->id);
            $data->update([
                'status' => $request->status? 1 : 0
            ]);
            return back()->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
    public function imageDelete($id)
    {
        try {
            $data = PortfolioImage::findOrFail($id);
            secureUnlink($data->image_path);
            $data->delete();
            return back()->with('success', 'Data deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

}
