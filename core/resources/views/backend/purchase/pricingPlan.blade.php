@extends('backend.master')

@section('title', 'Pricing Plans')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                @foreach($pricingPlans as $plan)
                <div class="col-md-4 col-lg-4 col-sm-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{asset('assets/images/price-list.png')}}"
                                    alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{$plan->title}}</h3>
                            <h5 class="text-center"><span class="currency-symbol">{{$plan->currency == 'bdt' ? '৳' : '$'}} </span> {{ $plan->price }}</h5>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Credits</b> <span class="float-right">{{$plan->credits}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Links Submit</b> <a class="float-right">{{$plan->link_submit}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Time Limit</b> <a class="float-right">Unlimited</a>
                                </li>
                            </ul>
                            <a href="{{route('user.checkout',$plan->id)}}" class="btn btn-primary btn-block"><b>Purchase</b></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
