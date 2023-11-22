@extends('frontend.master')

@section('title', 'Page not found')

@section('content')
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Page not found</h2>
            <ol>
                <li><a href="{{ url('/') }}">Home</a></li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-2">
            </div>
            <div class="col-md-8 text-center animate-box">
                <h1 class="portfolio-title">404 - Page not found</h1>
                <h5>We couldn't find the page you're looking for. Please double-check the URL or return to our homepage to navigate your way.</h5>
                <p><a class="btn btn-primary btn-lg" href="{{url('/')}}">Back to Home</a></p>
                <img class="img-responsive" src="{{asset('assets/images/404-error.png')}}" alt="404" style="margin:0 auto;">
            </div>
        </div>
    </div>
</div>
@endsection