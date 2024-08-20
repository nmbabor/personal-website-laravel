@extends('frontend.master')

@section('title', readConfig('site_name'))


@section('hero')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center" style="background-image:url({{imageRecover(readConfig('hero_photo'))}})">
        <div class="hero-container" data-aos="fade-in">
            <h1>{{ readConfig('site_name') }}</h1>
            <p>I'm <span class="typed" data-typed-items="{{ $textSlider }}"></span></p>
        </div>
    </section><!-- End Hero -->
@endsection
@section('content')
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="section-title">
                <h2>About</h2>
                <p> {!! readconfig('short_description') !!} </p>
            </div>

            <div class="row">
                <div class="col-lg-4" data-aos="fade-right">
                    <img src="{{ imageRecover(readconfig('skill_photo')) }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                    <h3>Key Skills</h3>
                    <p class="fst-italic">
                        {{ readconfig('skill_title') }}
                    </p>
                    <div class="row">
                        @foreach ($skills as $fiveSkill)
                            <div class="col">
                                <ul>
                                    @foreach ($fiveSkill as $skill)
                                        <li><i class="bi bi-chevron-right"></i> <strong>{{ $skill }}</strong></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->



    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Resume</h2>
                <p>
                    {!! readConfig('resume_description') !!}
                </p>
            </div>

            <div class="row">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="resume-title">Professional Experience</h3>
                    @foreach ($experiences as $exp)
                        <div class="resume-item">
                            <h4>{{ $exp->designation }}</h4>
                            <h5> {{ $exp->time_period }} </h5>
                            <p><em><b>Company:</b> {{ $exp->company }} </em></p>
                            @php
                                $expDetails = explode('# ', $exp->description);
                            @endphp
                            <ul>
                                @foreach (array_filter($expDetails) as $expDetail)
                                    <li> {{ $expDetail }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-6" data-aos="fade-up">
                    <h3 class="resume-title">Education</h3>
                    @foreach ($educations as $edu)
                        <div class="resume-item">
                            <h4>{{ $edu->qualification }}</h4>
                            <h5>{{ $edu->passing_year }}</h5>
                            <p><em>{{ $edu->institute }}</em></p>
                            <p>{!! $edu->description !!}</p>
                            @if ($edu->result != '')
                                <p> <b>Result:</b> {{ $edu->result }} </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section><!-- End Resume Section -->
    <!-- ======= Facts Section ======= -->
    <section id="facts" class="facts" style="display: none">
        <div class="container">

            <div class="section-title">
                <h2>Facts</h2>
                <p>
                    I worked on 40+ Projects in the last 7 years. In this long journey I have worked on many projects, I
                    have worked in a few companies and I have done many personal projects. I have handled many clients.
                    Mainly working with PHP laravel, Mysql, Jquery, Nodejs, ReactJs, VueJs, ExpressJs are mentionable.
                    Completed web based projects are e-commerce, Education management system, Inventory Management, Hospital
                    Management, Event Management, Travel & Tourism, News portal ect.
                </p>
            </div>

            <div class="row no-gutters">

                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
                    <div class="count-box">
                        <i class="bi bi-emoji-smile"></i>
                        <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p><strong>Happy Clients</strong></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="count-box">
                        <i class="bi bi-journal-richtext"></i>
                        <span data-purecounter-start="0" data-purecounter-end="40" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p><strong>Completed Projects</strong></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="200">
                    <div class="count-box">
                        <i class="bi bi-diamond-half"></i>
                        <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p><strong>On Going Projects</strong></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="300">
                    <div class="count-box">
                        <i class="bi bi-people"></i>
                        <span data-purecounter-start="0" data-purecounter-end="130" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p><strong>Students</strong></p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Facts Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="technology ">
        <div class="container">

            <div class="section-title">
                <h2>Usage Technology</h2>
                <p> {{ readConfig('technology_description') }} </p>
            </div>

            <div class="row portfolio-technology">
                @foreach ($technology as $tech)
                    <div class="col-md-4 mb-4">
                        <div class="card mb-3">
                            <a class="row g-0" href="{{ url('technology/' . $tech->slug) }}">
                                <div class="col-md-3 verticle-align-center p-1">
                                    <img src="{{ imageRecover($tech->icon) }}" class="img-fluid"
                                        alt="{{ $tech->title }}">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold mb-2">{{ $tech->title }} {{--<span
                                                class="badge @if ($tech->percentage > 79) bg-success @else bg-brand @endif">{{ $tech->percentage }}%</span>--}}
                                        </h5>
                                        <p class="card-text mt-3"> {!! $tech->meta_description !!} </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Portfolio</h2>
                <p> {!! readConfig('portfolio_description') !!} </p>
            </div>

            <div class="row" data-aos="fade-up">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        @foreach ($portfolioCategory as $proCat)
                            <li data-filter=".filter-{{ $proCat->slug }}">{{ $proCat->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
                @foreach ($portfolio as $port)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $port->category->slug ?? '' }}">
                        <div class="portfolio-wrap">
                            <img src="{{ imageRecover($port->thumbnail) }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ imageRecover($port->thumbnail) }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="{{ $port->project_name }}"><i
                                        class="bx bx-zoom-in"></i></a>
                                <a href="{{ url('portfolio', $port->slug) }}" title="More Details"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">

            <div class="section-title">
                <h2>Services</h2>
                <p> {!! readConfig('services_description') !!} </p>

            </div>

            <div class="row">
                @foreach ($services as $service)
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                        <div class="icon">
                            @if ($service->icon_class != '')
                                <i class="{{ $service->icon_class }}"></i>
                            @else
                                <img src="{{ imageRecover($service->icon) }}" class="img-fluid" style="width: 70%">
                            @endif
                        </div>
                        <h4 class="title"><a href="{{url('service',$service->slug)}}"> {{ $service->title }} </a></h4>

                        <p class="description"> {{ $service->meta_description }} </p>
                    </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Blog Section ======= -->
    <section id="blogs" class="blogs section-bg">
        <div class="container">

            <div class="section-title">
                <h2>From Blogs</h2>
                <p> {!! readConfig('blog_description') !!} </p>

            </div>


            <div class="row row-cols-1 row-cols-md-3 g-4">
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
            <div class="d-grid gap-2 col-6 mx-auto mt-3">
                <a href="{{url('blogs')}}" class="btn btn-outline-brand"> <i class="bi bi-grid"></i> Explore All Blogs</a>
              </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container">

            <div class="section-title">
                <h2>Testimonials</h2>
                <p> {{ readConfig('testimonials_description') }} </p>
            </div>

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="testimonial-item" data-aos="fade-up">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    {!! $testimonial->description !!}
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="{{ imageRecover($testimonial->icon) }}" class="testimonial-img"
                                    alt="">
                                <h3> {{ $testimonial->name }} </h3>
                                <h4>{{ $testimonial->designation }} at <b>{{ $testimonial->company }}</b> </h4>
                            </div>
                        </div><!-- End testimonial item -->
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Contact</h2>
                <p>To reach out to me for any web-related services, please feel free to contact me via the provided address,
                    email, or mobile number. I am readily available and look forward to assisting you with your specific
                    needs.</p>
            </div>

            <div class="row" data-aos="fade-in">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Location:</h4>
                            <p>{{ readconfig('contact_address') }}</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Email:</h4>
                            <p><a href="mailto:{{ readconfig('contact_email') }}">{{ readconfig('contact_email') }}</a>
                            </p>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Call:</h4>
                            <p class="no-margin"><a
                                    href="tel:{{ readconfig('contact_mobile') }}">{{ readconfig('contact_mobile') }}</a>
                            </p>
                        </div>


                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <iframe src="{{ readconfig('google_map') }}" width="100%" height="290" style="border:0;"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->
@endsection
