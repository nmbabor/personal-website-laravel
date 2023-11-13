@extends('backend.master')

@section('title', 'Transection Details')
@section('title_button')
    <a href="{{ route('user.transections') }}" class="btn bg-gradient-primary">
        <i class="fas fa-list"></i>
        View All
    </a>
@endsection

@section('content')
    <!-- Main content -->
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <img src="{{ imageRecover(readconfig('site_logo')) }}" alt="Logo" style="height: 50px;">
                    <small class="float-right">Date: {{ date('d-m-Y', strtotime($data->created_at)) }} </small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <b>Invoice: {{$data->invoice_no}}</b><br>
                <b>Status: </b> @if($data->is_paid==1) <span class="text-success"> Success </span> @else <span class="text-warning"> Pending </span> @endif <br>
                <b>Date: </b> {{ date('d-m-Y', strtotime($data->created_at)) }}<br>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>{{$data->user->name??""}}</strong><br>
                    Email: {{$data->user->email ?? ''}}
                </address>
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Package</th>
                            <th>Description</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> {{$data->plan->title ?? ''}} </td>
                            <td> Credits : {{$data->credits}}, Link Submit: {{$data->link_submit}} </td>
                            <td class="text-right"><span class="currency-symbol"> {{$data->plan->currency == 'bdt' ? '৳' : '$'}} </span> {{$data->total_amount + $data->discount }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                <p class="lead">Payment Methods:</p>
                <img class="pgw-icon" src='{{ asset("assets/images/pgw/$data->payment_method.png") }}' alt="bank">
                @if($data->payer_email != '')
                <p class="mb-1"><b>Payer Email: </b> {{$data->payer_email}} </p>
                @endif
                @if($data->trans_id != '')
                <p class="mb-1"><b>Transection ID:  </b> {{$data->trans_id}} </p>
                @endif
                @if($data->others_info != '')
                <p class="text-muted well well-sm shadow-none">
                 <b>Note: </b> {{$data->others_info}}
                </p>
                @endif
                @if($data->pop_photo != '')
                <p class="no-print"> <b>Attachment:</b> <br> <a href="{{imageRecover($data->pop_photo)}}" download> <img src="{{imageRecover($data->pop_photo)}}" style="height: 80px; max-width: 100%"> </a> </p>
                @endif
            </div>
            <!-- /.col -->
            <div class="col-6">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td class="text-right"> <span class="currency-symbol"> {{$data->plan->currency == 'bdt' ? '৳' : '$'}} </span> {{$data->total_amount + $data->discount }} </td>
                        </tr>
                        @if($data->discount > 0)
                        <tr>
                            <th>Discount ({{$data->discount_code}})</th>
                            <td class="text-right"> - <span class="currency-symbol"> {{$data->plan->currency == 'bdt' ? '৳' : '$'}} </span> {{$data->discount}}</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Total:</th>
                            <td class="text-right"> <span class="currency-symbol"> {{$data->plan->currency == 'bdt' ? '৳' : '$'}} </span> {{$data->total_amount}} </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    @if($data->is_paid==0)
                    <p>
                       <span class="text-danger">NB:</span> The payment is currently being processed manually and is pending approval from the administrator.
                    </p>
                    @endif
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        {{-- <div class="row no-print">
            <div class="col-12">
                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                        class="fas fa-print"></i> Print</a>
            </div>
        </div> --}}
    </div>
@endsection
