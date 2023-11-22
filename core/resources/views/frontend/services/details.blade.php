@extends('frontend.master')

@section('title', $data->title)
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Service Details</h2>
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Service Details</li>
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
                        @if ($data->icon_class != '')
                        <div class="service-icon">
                            <i class="{{ $data->icon_class }}"></i>
                        </div>
                        @else
                            <img src="{{ imageRecover($data->icon) }}" alt="{{ $data->title }}">
                        @endif
                        <h2 class="mb-2 mt-2 fs-4 fw-bold"> {{ $data->title }} </h2>
                        <p> {{$data->meta_description}} </p>
                    </div>
                    <div>
                        {!! $data->description !!}
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info services mb-2 p-4">
                        <h3>Services</h3>
                        @foreach ($services as $servKey => $service)
                            <div class="col-md-12 icon-box @if(count($services) > ($servKey+1)) border-bottom @endif" data-aos="fade-up">
                                <div class="icon">
                                    @if ($service->icon_class != '')
                                        <i class="{{ $service->icon_class }}"></i>
                                    @else
                                        <img src="{{ imageRecover($service->icon) }}" class="img-fluid" style="width: 70%">
                                    @endif
                                </div>
                                <h4 class="title mb-1"><a href="{{ url('service', $service->slug) }}"> {{ $service->title }} </a>
                                </h4>

                                <p class="description"> {{ $service->meta_description }} </p>
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
