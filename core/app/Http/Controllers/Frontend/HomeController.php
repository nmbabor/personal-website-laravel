<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Technology;
use App\Models\TextSlider;


class HomeController extends Controller
{
    public function index(){
        $blogs = Blog::whereStatus(1)->latest()->take(3)->get();
        $sliders = TextSlider::whereStatus(1)->latest()->pluck('title')->toArray();
       $textSlider = implode(', ',$sliders);
       // Skills text to array to chunk
       $skills = readConfig('skills');
       $skills = explode(', ', $skills);
       $skills = array_chunk($skills,5);

       $educations = Education::whereStatus(1)->latest()->get();
       $experiences = Experience::whereStatus(1)->latest()->get();

       $technology = Technology::whereStatus(1)->get();

       $portfolioCategory = PortfolioCategory::whereStatus(1)->get();
       $portfolio = Portfolio::whereStatus(1)->latest()->get();
        
        return view('frontend.index',compact('blogs','textSlider','skills','educations','experiences','technology','portfolioCategory','portfolio'));
    }
    public function blogs(){
        $blogs = Blog::whereStatus(1)->latest()->paginate(12);
        return view('frontend.blog.index',compact('blogs'));
    }
    
    public function blogCategory($slug){
        $category = BlogCategory::where('slug',$slug)->firstOrFail();
        $blogs = Blog::whereStatus(1)->latest()->where('blog_category_id',$category->id)->paginate(12);
        return view('frontend.blog.index',compact('blogs','category'));
    }
    public function singleBlog($slug){
        $data = Blog::whereStatus(1)->where('slug',$slug)->firstOrFail();
        $categories = BlogCategory::whereStatus(1)->get();
        return view('frontend.blog.single',compact('data','categories'));
    }
    public function singlePage($slug){
        $data = Page::whereStatus(1)->where('slug',$slug)->firstOrFail();
        return view('frontend.singlePage',compact('data'));
    }
    
    public function portfolio($slug){
        return view('frontend.portfolio.details');
    }

    
}
