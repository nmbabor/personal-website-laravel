@extends('frontend.master')

@section('title', $data->title)
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Portfolio Details</h2>
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
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
                    <h2 class="portfolio-title mb-4 fs-4">  {{$data->title}} </h2>
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">

                            <div class="swiper-slide">
                                <img src="{{ imageRecover($data->thumbnail) }}"
                                    alt="">
                            </div>
                            @foreach($data->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ imageRecover($image->image_path) }}" alt="">
                            </div>  
                            @endforeach

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info mb-2 p-4">
                        <h3>Project information</h3>
                        <ul class="mb-0">
                            <li><strong>Name</strong>: {{$data->title}} </li>
                            <li><strong>Category</strong>: {{$data->category->title}} </li>
                            @if($data->client_name != '')
                            <li><strong>Client</strong>:  {{$data->client_name}}</li>
                            @endif
                            @if($data->time_period != '')
                            <li><strong>Project date</strong>: {{$data->time_period}} </li>
                            @endif
                            @if($data->live_url != '')
                            <li><strong>Project URL</strong>: <a href="{{$data->live_url}}" target="_blank"> {{$data->live_url}} </a></li>
                            @endif
                        </ul>
                    </div>
                    @if($data->yt_video_id != '')
                    <div class="portfolio-video" data-bs-toggle="modal" data-bs-target="#videoModal" role="button">
                        <img class="img-fluid" src="{{ imageRecover($data->thumbnail) }}">
                        <div class="video-overlay">
                            {{-- <i class="bx bxl-youtube"></i> --}}
                            <img src="{{ asset('assets/images/portfolio/youtube.gif') }}">
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body p-1">
                                    <div class="col-md-12">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div id="youtubePlayer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>

            </div>
            <div class="row gy-4">
                <div class="col-md-12">
                    <div class="portfolio-description">
                        <h3 class="portfolio-title"> Descriptions</h3>
                        <div>
                            {!! $data->description !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-4 portfolio-keyfeatures mt-3">
                <div class="col-md-12">
                    <h3 class="portfolio-title">Key features</h3>
                </div>
                @foreach($data->features as $feature)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon mb-2">
                                <img class="img-fluid" src="{{ imageRecover($feature->icon) }}"
                                    alt="Classroom">
                            </div>
                            <h5 class="card-title text-center fw-bold">{{$feature->title}}</h5>
                            <p class="card-text">
                                {!! $feature->description !!}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row gy-4 portfolio-technology mt-4">
                <div class="col-md-12">
                    <h3 class="portfolio-title">Technologies used</h3>
                </div>
                @foreach($data->technologies as $tech)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <a class="row g-0" href="{{url('technology',$tech->technology->slug)}}">
                            <div class="col-md-3 verticle-align-center">
                                <img src="{{ imageRecover($tech->technology->icon) }}" class="img-fluid"
                                    alt="...">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"> {{$tech->technology->title}} </h5>
                                    <p class="card-text"> {{$tech->technology->meta_description}} </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

@endsection
@push('script')
@if($data->yt_video_id != '')
<script>
  createYouTubePlayer('{{$data->yt_video_id}}');

  // Function to create and control the YouTube video
  function createYouTubePlayer(videoId) {
    // Create an iframe element
    var iframe = document.createElement('iframe');
    iframe.src = 'https://www.youtube.com/embed/' + videoId + '?enablejsapi=1';
    iframe.width = '100%';
    iframe.height = '450px';
    iframe.allow = 'autoplay; encrypted-media';
    iframe.allowFullscreen = true;

    // Append the iframe to the modal body
    document.getElementById('youtubePlayer').appendChild(iframe);

    // Load the YouTube API script
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // Function called when the YouTube API is ready
    window.onYouTubeIframeAPIReady = function () {
      // Create a new YouTube player
      window.player = new YT.Player(iframe, {
        events: {
          'onReady': onPlayerReady,
        }
      });
    };
  }

  // Function called when the player is ready
  function onPlayerReady(event) {
    // Play the video when the modal is opened
    var modal = new bootstrap.Modal(document.getElementById('videoModal'));
    modal._element.addEventListener('shown.bs.modal', function () {
      player.playVideo();
    });

    // Pause the video when the modal is closed
    modal._element.addEventListener('hidden.bs.modal', function () {
      player.pauseVideo();
    });
  }

  // Function called when the modal is hidden to stop the video
  /* document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
    if (window.player) {
      window.player.stopVideo();
    }
  }); */
  
</script>
@endif
@endpush
