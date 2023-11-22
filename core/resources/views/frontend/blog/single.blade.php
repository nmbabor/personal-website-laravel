@extends('frontend.master')

@section('title', $data->title)
    @if($data->meta_description != '')
        @section('meta_description', $data->meta_description)
    @endif
    @if($data->meta_tags != '')
        @section('meta_keywords', $data->meta_tags)
    @endif
    @if($data->thumbnail != '')
        @section('og_image', imageRecover($data->thumbnail))
    @endif

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Blog Details</h2>
            <ol>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/blogs') }}">Blogs</a></li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->
<section id="portfolio-details" class="portfolio-details blogs">
    <div class="container">
        <div class="row">
            <div class="col-md-8 heading-section animate-box">
                <h2 class="portfolio-title mb-4">  {{$data->title}} </h2>
                <div class="blog-image">
                    <img class="img-responsive" src="{{imageRecover($data->thumbnail)}}" alt="{{$data->title}}">
                </div>
                <div class="blog-tag my-3">
                    <span class="comment pe-2"> <a href="{{route('frontend.blogs.category',$data->category->slug)}}"> <i class="bi bi-folder"></i> {{$data->category->title??""}} </a></span>
                    <span class="posted_by"> <i class="bi bi-person-lines-fill"></i> {{$data->author->name??''}} </span>
                </div>
                <div class="blog-description">
                    {!! $data->description !!}
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="portfolio-info mb-2 p-4">
                    <h3 class="portfolio-title pb-2"> Categories </h3>
                    <ul class="">
                        @foreach($categories as $cat)
                        <li class=""><a href="{{route('frontend.blogs.category',$cat->slug)}}"> <i class="bi bi-folder"></i> {{$cat->title}} </a></li>
                        @endforeach
                    </ul>
                    <h3 class="portfolio-title pb-2">Recent Blogs</h3>
                        @foreach ($recentBlogs as $blog)
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <a class="row g-0" href="{{ url('blog', $blog->slug) }}">
                                        <div class="col-md-3 verticle-align-center p-1">
                                            <img src="{{ imageRecover($blog->thumbnail) }}" class="img-fluid"
                                                alt="...">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body p-2">
                                                <h6 class=""> {{ $blog->title }} </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection