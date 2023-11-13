@extends('backend.master')

@section('title', 'Payment Gateway Settings')

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Payment Gateway
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-5 col-sm-3 general-settings">
                    <div class="nav flex-column nav-tabs h-100 vertical-nav-tabs" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link {{ @$_GET['tab'] == 'bank' ? 'active' : '' }}" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home"
                            role="tab" aria-controls="vert-tabs-home" aria-selected="true">Bank Transfer</a>
                        <a class="nav-link {{ @$_GET['tab'] == 'paypal' ? 'active' : '' }}" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile"
                            role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Paypal</a>
                        <a class="nav-link {{ @$_GET['tab'] == 'aamarpay' ? 'active' : '' }}" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages"
                            role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Aamarpay</a>
                    </div>
                </div>
                <div class="col-7 col-sm-9">
                    <form action="{{ route('settings.payment-gateway.update') }}" method="post">
                        @csrf
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade {{ @$_GET['tab'] == 'bank' ? 'active show' : '' }}" id="vert-tabs-home" role="tabpanel"
                            aria-labelledby="vert-tabs-home-tab">
                            <div class="form-group">
                                <label class="col-md-12">Bank Status</label>
                                <div class="col-md-6">
                                    {{Form::select('bank_status',[1=>'Active',0=>'Inactive'],readConfig('bank_status'),['class'=>'form-control'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Bank Name</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="bank_name" type="text"
                                    value="{{ readConfig('bank_name') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Account Name</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="ac_name" type="text"
                                    value="{{ readConfig('ac_name') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Account Number</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="ac_no" type="text"
                                    value="{{ readConfig('ac_no') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Swift Code</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="swift_code" type="text"
                                    value="{{ readConfig('swift_code') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Routing No</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="routing_no" type="text"
                                    value="{{ readConfig('routing_no') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Extra Instructions</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="bank_instruction">{{ readConfig('bank_instruction') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ @$_GET['tab'] == 'paypal' ? 'active show' : '' }}" id="vert-tabs-profile" role="tabpanel"
                            aria-labelledby="vert-tabs-profile-tab">
                            <div class="form-group">
                                <label class="col-md-12">Paypal Status</label>
                                <div class="col-md-6">
                                    {{Form::select('paypal_status',[1=>'Active',0=>'Inactive'],readConfig('paypal_status'),['class'=>'form-control'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Paypal Email</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="paypal_email" type="text"
                                    value="{{ readConfig('paypal_email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Extra Instructions</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="paypal_instruction">{{ readConfig('paypal_instruction') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ @$_GET['tab'] == 'aamarpay' ? 'active show' : '' }}" id="vert-tabs-messages" role="tabpanel"
                            aria-labelledby="vert-tabs-messages-tab">
                            <div class="form-group">
                                <label class="col-md-12">Aamarpay Status</label>
                                <div class="col-md-6">
                                    {{Form::select('aamarpay_status',[1=>'Active',0=>'Inactive'],readConfig('aamarpay_status'),['class'=>'form-control'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                
                                <label class="col-md-12">AamarPay Store ID</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="aamarpay_store_id" type="text"
                                    value="{{ readConfig('aamarpay_store_id') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                
                                <label class="col-md-12">AamarPay Signature Key</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="aamarpay_key" type="text"
                                    value="{{ readConfig('aamarpay_key') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary mt-2"> Submit </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
