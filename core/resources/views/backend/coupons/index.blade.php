@extends('backend.master')

@section('title', 'Coupons')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 border-right">
                    <fieldset>
                        <form action="{{ route('coupons.store') }}" method="post" id="addNewData">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label> Coupon Name <span class="text-danger">*</span> : </label>
                                        <input type="text" class="form-control" placeholder="" name="coupon_name">
                                        @error('coupon_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label> Coupon Code <span class="text-danger">*</span> : </label>
                                        <input type="text" class="form-control" placeholder="" name="coupon_code">
                                        @error('coupon_code')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label> Minimum purchase amount   <span class="text-danger">*</span> : </label>
                                        <input type="number" min="0" class="form-control" placeholder="" name="min_purchase">
                                        @error('min_purchase')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label> Maximum discount amount <span class="text-danger">*</span> : </label>
                                        <input type="number" min="0" class="form-control" placeholder="" name="max_discount">
                                        @error('max_discount')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label> Discount type   <span class="text-danger">*</span> : </label>
                                        {!! Form::select('type',['1' =>'Amount','2'=>'Percent (%)'], '1', ['class' => 'form-control','required']) !!}
                                        @error('type')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label> Discount Value <span class="text-danger">*</span> : </label>
                                        <input type="number" min="0" class="form-control" placeholder="" name="discount_value">
                                        @error('discount_value')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label> Start time <span class="text-danger">*</span> : </label>
                                        <input type="text" class="form-control singleDatePicker" placeholder="" name="start_date" autocomplete="off">
                                        @error('start_date')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label> End time : </label>
                                        <input type="text" class="form-control singleDatePicker" placeholder="" name="end_date" autocomplete="off">
                                        @error('end_time')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label> How many time use (QTY): </label>
                                        <input type="number" min="1" class="form-control" placeholder="" name="qty">
                                    </div>
                                    <div class="col-md-6">
                                        <label> Status: </label>
                                        {!! Form::select('status',['1' =>'Active','0'=>'Inactive'], '1', ['class' => 'form-control','required']) !!}
                                        @error('status')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-gradient-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </fieldset>
                    <hr>
                </div>

                <div class="col-md-7 table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Value</th>
                                <th>Qty</th>
                                <th>Used</th>
                                <th>Status</th>
                                <th class="text-center" width="5%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $data)
                                <tr>
                                    <td>{{ $data->coupon_name }}</td>
                                    <td>{{ $data->coupon_code }}</td>
                                    <td>  {{ $data->discount_value }} {{$data->type==2?'%':'TK'}}</td>
                                    <td>{{ $data->qty }}</td>
                                    <td>{{ $data->used_qty }}</td>
                                    <td>
                                        @if($data->status==1)
                                        <span class="badge badge-success" title="Active"> <i class="fa fa-check"></i> </span>
                                        @else
                                        <span class="badge badge-danger" title="Inactive"> <i class="fa fa-times"></i> </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <!-- Button trigger modal -->
                                            <button title="Edit Data" type="button" class="btn btn-info btn-xs"
                                                data-toggle="modal" data-target="#editData-{{ $data->id }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <a class="btn btn-danger btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Data"
                                                                href="javascript:void(0)"
                                                                onclick='resourceDelete("{{ route('coupons.destroy', $data->id) }}")'>
                                                                <span class="delete-icon">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editData-{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    {!! Form::open(['method' => 'put', 'route' => ['coupons.update', $data->id]]) !!}
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fs-5" id="exampleModalLabel">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Edit Coupons
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label> Coupon Name <span class="text-danger">*</span> : </label>
                                                                    <input type="text" class="form-control" value="{{$data->coupon_name}}" name="coupon_name">
                                                                    @error('coupon_name')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label> Coupon Code <span class="text-danger">*</span> : </label>
                                                                    <input type="text" class="form-control" value="{{$data->coupon_code}}" name="coupon_code">
                                                                    @error('coupon_code')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label> Minimum purchase amount   <span class="text-danger">*</span> : </label>
                                                                    <input type="number" min="0" class="form-control" value="{{$data->min_purchase}}" name="min_purchase">
                                                                    @error('min_purchase')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label> Maximum discount amount <span class="text-danger">*</span> : </label>
                                                                    <input type="number" min="0" class="form-control" value="{{$data->max_discount}}" name="max_discount">
                                                                    @error('max_discount')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label> Discount type   <span class="text-danger">*</span> : </label>
                                                                    {!! Form::select('type',['1' =>'Amount','2'=>'Percent (%)'], $data->type, ['class' => 'form-control','required']) !!}
                                                                    @error('type')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label> Discount Value <span class="text-danger">*</span> : </label>
                                                                    <input type="number" min="0" class="form-control" value="{{$data->discount_value}}" name="discount_value">
                                                                    @error('discount_value')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label> Start time <span class="text-danger">*</span> : </label>
                                                                    <input type="text" class="form-control singleDatePicker" value="{{date('d-m-Y',strtotime($data->start_date))}}" name="start_date" autocomplete="off">
                                                                    @error('start_date')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label> End time : </label>
                                                                    <input type="text" class="form-control singleDatePicker" value="{{$data->end_date != '' ? date('d-m-Y',strtotime($data->end_date)) : '' }}" name="end_date">
                                                                    @error('end_time')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label> How many time use (QTY): </label>
                                                                    <input type="number" min="1" class="form-control" value="{{$data->qty}}" name="qty">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label> Status: </label>
                                                                    {!! Form::select('status',[1=>'Active', 0 =>'Inactive'], $data->status, ['class' => 'form-control','required']) !!}
                                                                    @error('status')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn bg-gradient-primary">
                                                            Save changes
                                                        </button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection



