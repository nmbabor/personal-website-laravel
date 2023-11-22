@extends('frontend.master')

@section('title', $data->title)
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Technology Details</h2>
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Technology Details</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="text-center">
                        <img src="{{ imageRecover($data->icon) }}" alt="{{ $data->title }}">
                        <h2 class="mb-2 fs-4 fw-bold"> {{ $data->title }} </h2>
                        <p> {{$data->meta_description}} </p>
                    </div>
                    <div>
                        {!! $data->description !!}
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info portfolio-technology mb-2 p-4">
                        <h3>Usage Technologies</h3>
                        @foreach ($technologies as $tech)
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <a class="row g-0" href="{{ url('technology', $tech->slug) }}">
                                        <div class="col-md-3 verticle-align-center">
                                            <img src="{{ imageRecover($tech->icon) }}" class="img-fluid"
                                                alt="...">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <h5 class="card-title fw-bold"> {{ $tech->title }} </h5>
                                                <p class="card-text"> {{ $tech->meta_description }} </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="row gy-4">
                <div class="col-md-12">

                </div>
            </div>


        </div>
    </section><!-- End Portfolio Details Section -->

@endsection
