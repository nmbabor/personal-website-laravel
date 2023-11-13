@extends('backend.master')

@section('title', 'Pricing Plan')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 border-right">
                    <fieldset>
                        <form action="{{ route('pricing-plan.store') }}" method="post" id="addNewData">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-12"> Title <span class="text-danger">*</span> : </label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Title" name="title">
                                    @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 pl-0"> Price &amp; Credits <span class="text-danger">*</span> : </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" min="0" class="form-control" placeholder="Price" name="price">
                                        @error('price')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" min="1" class="form-control" placeholder="Credits" name="credits">
                                        @error('credits')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 pl-0"> Link Submit &amp; Currency <span class="text-danger">*</span> : </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" min="0" class="form-control" placeholder="Link Submit" name="link_submit">
                                        @error('link_submit')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::select('currency',['bdt' =>'BDT','usd'=>'USD'], 'bdt', ['class' => 'form-control','required']) !!}
                                        @error('currency')
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
                                <th>Title</th>
                                <th>Price</th>
                                <th width="5%">Status</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="row_position">
                            @foreach ($allData as $data)
                                <tr id="{{$data->id}}" class="cursor-move">
                                    <td>{{ $data->title }}</td>
                                    <td> <b class="currency-symbol">{{$data->currency == 'bdt' ? '৳' : '$'}} </b> {{ $data->price }}</td>
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
                                            <button title="Edit Category" type="button" class="btn btn-info btn-xs"
                                                data-toggle="modal" data-target="#editCategory-{{ $data->id }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <a class="btn btn-danger btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Data"
                                                                href="javascript:void(0)"
                                                                onclick='resourceDelete("{{ route('pricing-plan.destroy', $data->id) }}")'>
                                                                <span class="delete-icon">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editCategory-{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                {!! Form::open(['method' => 'put', 'route' => ['pricing-plan.update', $data->id]]) !!}
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fs-5" id="exampleModalLabel">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Edit Pricing Plan
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label">Title:</label>
                                                            {!! Form::text('title', $data->title, ['class' => 'form-control', 'placeholder' => 'Title','required']) !!}
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="col-md-12 pl-0"> Price &amp; Credits <span class="text-danger">*</span> : </label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="number" min="0" value="{{$data->price}}" class="form-control" placeholder="Price" name="price">
                                                                    @error('price')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="number" min="1" value="{{$data->credits}}" class="form-control" placeholder="Credits" name="credits">
                                                                    @error('credits')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-12 pl-0"> Link Submit &amp; Currency <span class="text-danger">*</span> : </label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="number" min="0" value="{{$data->link_submit}}" class="form-control" placeholder="Link Submit" name="link_submit">
                                                                    @error('link_submit')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-6">
                                                                    {!! Form::select('currency',['bdt' =>'BDT','usd'=>'USD'], $data->currency, ['class' => 'form-control','required']) !!}
                                                                    @error('currency')
                                                                        <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Status:</label>
                                                            {!! Form::select('status',[1=>'Active', 0 =>'Inactive'], $data->status, ['class' => 'form-control','required']) !!}
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
                                                </div>
                                                {!! Form::close() !!}
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
@push('script')   
    <script>
        $( ".row_position" ).sortable({  
            delay: 150,  
            placeholder: "drop-zone",
            stop: function() {  
                var selectedData = new Array();  
                $('.row_position>tr').each(function() {  
                    selectedData.push($(this).attr("id"));  
                });  
                //console.log(selectedData);
                updateOrder(selectedData);  
            }  
        });
        function updateOrder(data) {  
            $.ajax({  
                url:"{{route('pricing-plan-serial-update')}}",  
                type:'PUT',  
                data:{position:data},  
                success:function(){  
                    console.log('Your change successfully saved');  
                },
                error: function(xhr, status, error) {
                    console.log(error)
                }
            })  
        } 
    </script>
@endpush


