@extends('backend.master')

@section('title', 'Checkout')
@section('title_button')
    <a href="{{ route('user.pricing-plans') }}" class="btn bg-gradient-primary">
        <i class="fas fa-list"></i>
        Pricing Plans
    </a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile">
                            <h5><span class="currency-symbol">Select your payment gateway</h5>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item" style="display:none">
                                    <div class="custom-control custom-radio pgw-list">
                                        <input class="custom-control-input" type="radio" id="stripe"
                                            name="payment_way">
                                        <label for="stripe" class="custom-control-label"> <img
                                                src="{{ asset('assets/images/pgw/stripe.png') }}" class="pgw-icon"> </label>

                                        <span class="float-right text-right">Stripe <br>
                                            <small>Automatic Approval System</small> </span>
                                    </div>
                                </li>
                                @if(readConfig('aamarpay_status'))
                                <li class="list-group-item">
                                    <div class="custom-control custom-radio pgw-list">
                                        <input class="custom-control-input" type="radio" id="aamarPay" name="payment_way"
                                            onchange="pgwSelect('aamarpay')">
                                        <label for="aamarPay" class="custom-control-label"> <img
                                                src="{{ asset('assets/images/pgw/aamarpay.png') }}" class="pgw-icon">
                                        </label>
                                        <span class="float-right text-right"> Aamar Pay <br>
                                            <small>Automatic Approval System</small> </span>
                                    </div>
                                </li>
                                @endif
                                @if(readConfig('paypal_status'))
                                <li class="list-group-item">
                                    <div class="custom-control custom-radio pgw-list">
                                        <input class="custom-control-input" type="radio" id="paypal" name="payment_way"
                                            onchange="pgwSelect('paypal')">
                                        <label for="paypal" class="custom-control-label"> <img
                                                src="{{ asset('assets/images/pgw/paypal.png') }}" class="pgw-icon"> </label>
                                        <span class="float-right text-right"> Paypal <br> <small>Manually
                                                Approval System</small></span>
                                    </div>
                                </li>
                                @endif
                                @if(readConfig('bank_status'))
                                <li class="list-group-item">
                                    <div class="custom-control custom-radio pgw-list">
                                        <input class="custom-control-input" type="radio" id="bank" name="payment_way"
                                            onchange="pgwSelect('bank')">
                                        <label for="bank" class="custom-control-label"><img
                                                src="{{ asset('assets/images/pgw/bank.png') }}" class="pgw-icon"> </label>
                                        <span class="float-right text-right"> Bank Transfer <br>
                                            <small>Manually Approval System</small> </span>
                                    </div>
                                </li>
                                @endif
                            </ul>
                            <p class="text-danger payment-method-error" style="display: none"> <i
                                    class="fa fa-info-circle"></i> Please choose a payment gateway!</p>
                            @error('payment_method')
                                <p class="text-danger"> <i class="fa fa-info-circle"></i> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="offset-2 col-md-8 mb-3">
                                <h4>Have a coupon code?</h4>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="code" id="coupon-code"
                                        placeholder="Coupon code">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat"
                                            onclick="couponValidation('{{ route('coupon-validation') }}')">Apply</button>
                                    </span>
                                </div>
                                <p class="text-danger" id="coupon-error" style="display: none"> Invalid Coupon </p>
                                <p class="text-success" id="coupon-success" style="display: none"> Successfully added </p>
                            </div>
                            <hr>
                            <h5><span class="currency-symbol">Order Summary</h5>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>{{ $plan->title }} <br> <small>Links: {{ $plan->link_submit }}, Credits:
                                            {{ $plan->credits }}</small> </b> <span class="float-right"><span
                                            class="currency-symbol">{{ $plan->currency == 'bdt' ? '৳' : '$' }} </span>
                                        {{ $plan->price }}</span>
                                </li>
                                <li class="list-group-item coupon-applied" style="display: none">
                                    <b>Coupon discount (<span id="applied-code"></span>)</b> <span class="float-right"> -
                                        <span class="currency-symbol">{{ $plan->currency == 'bdt' ? '৳' : '$' }} </span>
                                        <span id="coupon-amount"></span></span>
                                </li>
                                <li class="list-group-item">
                                    <b>Total</b> <span class="float-right">
                                        <span class="currency-symbol">{{ $plan->currency == 'bdt' ? '৳' : '$' }} </span>
                                        <span class="total_price grand-total">{{ $plan->price }}</span> </span>
                                </li>
                            </ul>
                            <div class="custom-control custom-checkbox mb-2">
                                <input class="custom-control-input" type="checkbox" id="terms-of-service" name="terms"
                                    value="1" required onchange="termsSelect()">
                                <label for="terms-of-service" class="custom-control-label">I agree with the <a
                                        href="{{ url('pages/term-condition') }}" target="_blank">terms of
                                        service.</a></label>
                                <p class="text-danger terms-error" style="display: none"> <i
                                        class="fa fa-info-circle"></i> Please Accept Terms &amp; Condition.</p>
                            </div>
                            <button class="btn btn-primary" type="button" onclick="submitForm()"><b>Pay
                                    Now</b></button>

                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"> <span class="text-capitalize pgw-text">bank</span> account informations </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        {!! Form::open(['route' => 'purchase-plan', 'class' => 'form-horizontal purchase-form', 'method' => 'POST','files'=>true]) !!}
                                        <div class="modal-body">
                                            <table class="table table-bordered mb-1 table-min-padding bank-info-table" style="display: none">
                                                <tr>
                                                    <td><b>Bank:</b> {{ readConfig('bank_name') }}</td>
                                                    <td><b>AC Name:</b> {{ readConfig('ac_name') }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>AC/No:</b> {{ readConfig('ac_no') }}</td>
                                                    <td><b>Swift Code:</b>{{ readConfig('swift_code') }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><b>Routing No:</b> {{ readConfig('routing_no') }}</td>
                                                </tr>
                                                @if(readConfig('bank_instruction') != '')
                                                <tr>
                                                    <td colspan="2">{{ readConfig('bank_instruction') }}</td>
                                                </tr>
                                                @endif
                                            </table>
                                            <table class="table table-bordered mb-1 table-min-padding paypal-info-table" style="display: none">
                                                <tr>
                                                    <td colspan="2"><b>Paypal Email:</b> {{ readConfig('paypal_email') }}</td>
                                                </tr>
                                                @if(readConfig('paypal_instruction') != '')
                                                <tr>
                                                    <td colspan="2">{{ readConfig('paypal_instruction') }}</td>
                                                </tr>
                                                @endif
                                            </table>
                                            <h5><b>Amount:</b> <span class="currency-symbol text-success">{{ $plan->currency == 'bdt' ? '৳' : '$' }} </span> <span class="grand-total text-success">{{ $plan->price }}</span></h5>
                                            <div class="mb-2 paypal-info-table" style="display: none">
                                                <label for="paypal_email" class="form-label">PayPal Email address <span class="text-danger">*</span> : </label>
                                                <input type="email" class="form-control" name="payer_email" id="paypal_email" required>
                                            </div>
                                            <div class="mb-2">
                                                <label for="trans_id" class="form-label">Transection ID: </label>
                                                <input type="text" class="form-control" id="trans_id" name="trans_id">
                                            </div>
                                            <div class="mb-2">
                                                <label for="others_info" class="form-label">Additional Info: </label>
                                                <textarea class="form-control" id="others_info" name="others_info"></textarea>
                                            </div>
                                            <div class="mb-2">
                                                <label for="pop_photo" class="form-label">Proof of payment: </label>
                                                <input type="file" class="form-control" id="pop_photo" name="pop_photo">
                                                <div id="emailHelp" class="form-text">Upload your transection screenshot.</div>
                                            </div>
                                            <input type="hidden" id="haveCoupon" name="discount_code" value="">
                                            <input type="hidden" id="couponValue" name="discount" value="0">
                                            <input type="hidden" name="pricing_plan_id" value="{{ $plan->id }}">
                                            <input type="hidden" name="total_amount" id="payable-price"
                                                value="{{ $plan->price }}">
                                            <input type="hidden" id="paymentMethod" name="payment_method"
                                                value="">
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>

                                </div>

                            </div> <!-- Modal -->




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function submitForm() {
            // payment mathod validation
            let pgw = $('#paymentMethod').val();
            if (pgw == '') {
                $('.payment-method-error').show();
                return;
            }
            // terms of condition checkbox validation
            if ($('#terms-of-service').is(':checked') == false) {
                $('.terms-error').show();
                $('#terms-of-service').addClass('is-invalid')
                return;
            }
            // form submit
            if(pgw !== 'aamarpay'){
                if(pgw=='bank'){
                    $('.bank-info-table').show();
                    $('.paypal-info-table').hide();
                    $('#paypal_email').prop('required',false);
                }else{
                    $('.bank-info-table').hide();
                    $('.paypal-info-table').show();
                    $('#paypal_email').prop('required',true);
                }
                $('#modal-default').modal({
                    show: true
                })
            }else{
                $('#paypal_email').prop('required',false);
                $('.purchase-form').submit();
            }

        }
        
        function termsSelect() {
            if ($('#terms-of-service').is(':checked')) {
                $('.terms-error').hide();
                $('#terms-of-service').removeClass('is-invalid');
            } else {
                $('.terms-error').show();
                $('#terms-of-service').addClass('is-invalid')
            }
        }

        function pgwSelect(pgw) {
            $('#paymentMethod').val(pgw)
            $('.pgw-text').html(pgw)
            $('.payment-method-error').hide();
        }

        function couponValidation(url) {
            let price = parseInt("{{ $plan->price }}");
            $('#coupon-error').hide();
            $('#coupon-success').hide();
            let code = $('#coupon-code').val();
            if (code == '') {
                $('#coupon-error').html('Write your code!')
                $('#coupon-error').show()
            } else {
                $.post(url, {
                    code,
                    price
                }, function(result, status) {
                    $('#coupon-success').show();
                    $('#applied-code').html(result.coupon_code);
                    $('#coupon-amount').html(parseInt(result.discount));
                    $('#couponValue').val(parseInt(result.discount));
                    let total = price - parseFloat(result.discount);

                    $('.grand-total').html(total);
                    $('#haveCoupon').val(result.coupon_code);
                    $('#payable-price').val(total);
                    $('.coupon-applied').show();
                    $('#coupon-code').attr('disabled', true);
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    let error = jqXHR.responseText.replace(/"/g, '');
                    $('#coupon-error').html(error);
                    $('#coupon-error').show();
                });
            }
        }
    </script>
@endpush
