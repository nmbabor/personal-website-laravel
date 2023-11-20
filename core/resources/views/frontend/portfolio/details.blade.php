@extends('frontend.master')

@section('title', 'Home')
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Portfolio Details</h2>
          <ol>
            <li><a href="{{url('/')}}">Home</a></li>
            <li>Portfolio Details</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <h2>  This is an example of portfolio project name </h2>
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="{{asset('assets/frontend//img/portfolio/portfolio-details-1.jpg')}}" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="{{asset('assets/frontend//img/portfolio/portfolio-details-2.jpg')}}" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="{{asset('assets/frontend//img/portfolio/portfolio-details-3.jpg')}}" alt="">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info mb-2 p-4">
              <h3>Project information</h3>
              <ul class="mb-0">
                <li><strong>Name</strong>: This is an example of portfolio project name this is an example of portfolio project name</li>
                <li><strong>Category</strong>: Web design</li>
                <li><strong>Client</strong>: ASU Company</li>
                <li><strong>Project date</strong>: 01 March, 2020</li>
                <li><strong>Project URL</strong>: <a href="#">www.example.com</a></li>
              </ul>
            </div>
            <div class="portfolio-video">
              <img class="img-fluid" src="{{asset('assets/images/portfolio/video-thumbnails.png')}}">
              <div class="video-overlay">
                <i class="bx bxl-youtube"></i>
              </div>
            </div>
            
          </div>

        </div>
        <div class="row gy-4">
          <div class="col-md-12">
            <div class="portfolio-description">
              <h3 class="portfolio-title"> Descriptions</h3>
              <p>
                Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.
              </p>
            </div>
          </div>
        </div>
        <div class="row gy-4 portfolio-keyfeatures mt-3">
          <div class="col-md-12">
            <h3 class="portfolio-title">Key features</h3>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="icon mb-2">
                  <img class="img-fluid" src="{{asset('assets/images/portfolio/classroom.png')}}" alt="Classroom">
                </div>
                <h5 class="card-title text-center fw-bold">Classroom</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="icon mb-2">
                  <img class="img-fluid" src="{{asset('assets/images/portfolio/classroom.png')}}" alt="Classroom">
                </div>
                <h5 class="card-title text-center fw-bold">Classroom</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.  build on the card title and make up the bulk of the card's content.</p>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.  build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="icon mb-2">
                  <img class="img-fluid" src="{{asset('assets/images/portfolio/classroom.png')}}" alt="Classroom">
                </div>
                <h5 class="card-title text-center fw-bold">Classroom</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="icon mb-2">
                  <img class="img-fluid" src="{{asset('assets/images/portfolio/classroom.png')}}" alt="Classroom">
                </div>
                <h5 class="card-title text-center fw-bold">Classroom</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.  build on the card title and make up the bulk of the card's content.</p>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.  build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="icon mb-2">
                  <img class="img-fluid" src="{{asset('assets/images/portfolio/classroom.png')}}" alt="Classroom">
                </div>
                <h5 class="card-title text-center fw-bold">Classroom</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row gy-4 portfolio-technology mt-4">
          <div class="col-md-12">
            <h3 class="portfolio-title">Technologies used</h3>
          </div>
          <div class="col-md-4">
            <div class="card mb-3">
              <a class="row g-0" href="#">
                <div class="col-md-3 verticle-align-center">
                  <img src="{{asset('assets/images/portfolio/vuejs.png')}}" class="img-fluid" alt="...">
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h5 class="card-title fw-bold">VueJs</h5>
                    <p class="card-text">Vue.js is a javascript framework developers mainly use to create interactive user interfaces.</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="card mb-3">
              <a class="row g-0" href="#">
                <div class="col-md-3 verticle-align-center">
                  <img src="{{asset('assets/images/portfolio/vuejs.png')}}" class="img-fluid" alt="...">
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h5 class="card-title fw-bold">Express Js</h5>
                    <p class="card-text">Vue.js is a javascript framework developers mainly use to create interactive user interfaces.</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="card mb-3">
              <a class="row g-0" href="#">
                <div class="col-md-3 verticle-align-center">
                  <img src="{{asset('assets/images/portfolio/nuxtjs.png')}}" class="img-fluid" alt="...">
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h5 class="card-title fw-bold">nuxt Js</h5>
                    <p class="card-text">Vue.js is a javascript framework developers mainly use to create interactive user interfaces.</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

@endsection
