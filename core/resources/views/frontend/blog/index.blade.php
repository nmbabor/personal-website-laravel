@extends('frontend.master')

@if(isset($category))
@section('title', $category->title . ' - Blogs')
    @if($category->description != '')
        @section('meta_description', $category->description)
    @endif
    @if($category->keywords != '')
        @section('meta_keywords', $category->keywords)
    @endif
@else
    @section('title', 'Blogs')
@endif

@section('content')
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Latest Blogs</h2>
            <ol>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/blogs') }}">Blogs</a></li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container">
        <div class="heading_container heading_center">
            <h3 class="fw-bold">
                Blogs
            </h3>
            <p class="border-bottom pb-3">
                {!! readConfig('blog_description') !!}
            </p>
            @if(isset($category))
                <small class="fs-6"> <i class="bi bi-folder"></i> {{$category->title}} </small>
            @endif
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
            @foreach($blogs as $blog)
            <div class="col">
                <div class="card h-100">
                    <a href="{{url('blog',$blog->slug)}}">
                    <img src="{{imageRecover($blog->thumbnail)}}" class="card-img-top" alt="{{$blog->title}}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><a href="{{url('blog',$blog->slug)}}"> {{$blog->title}} </a> </h5>
                        <p class="card-text">
                            <a href="{{route('frontend.blogs.category',$blog->category->slug)}}" class="me-3">
                                <i class="bi bi-folder"></i> {{$blog->category->title}}
                            </a>
                            <i class="bi bi-person-lines-fill"></i> {{$blog->author->name??''}}

                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12 mt-3 border-top pt-2">
                {{$blogs->links()}}
            </div>
        </div>
       
    </div>
</section>
@endsection