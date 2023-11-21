@extends('backend.master')

@section('title', 'Portfolio Features')
@section('title_button')
    <a href="{{ route('portfolio.projects.index') }}" class="btn bg-gradient-primary">
        <i class="fas fa-list"></i>
        View All Projects
    </a>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 border-right">
                    <fieldset>
                        <form action="{{ route('portfolio.features.store') }}" method="post" id="addNewData" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="portfolio_id" value="{{$data->id}}">
                            <div class="form-group">
                                <label class="col-md-12"> Name <span class="text-danger">*</span> : </label>
                                <div class="col-md-12">
                                    <input type="text" value="{{old('title')}}" class="form-control" placeholder="Name" name="title">
                                    @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Description : </label>
                                <div class="col-md-12">
                                    <textarea class="form-control" placeholder="Description" name="description" rows="4">{{old('description')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
                                <label for="icon" class="col-md-12"> Icon <span class="text-danger">*</span> : </label>
                                <div class="col-md-12">
                                    <label class="post_upload" for="file" style="height: 100px;width: 100px;">
                                        <!--  -->
                                        <img id="image_load" src="{{asset('assets/images/photo.png')}}">
                                    </label>
                                    {{Form::file('icon',array('id'=>'file','style'=>'display:none','onchange'=>"photoLoad(this,'image_load')"))}}
                                     @if ($errors->has('icon'))
                                            <span class="text-danger" style="display:block">
                                                <strong>{{ $errors->first('icon') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                            <div class="form-group">
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
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th colspan="2">Name</th>
                                <th width="5%">Status</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->features as $feature)
                                <tr>
                                    <td colspan="2" >{{ $feature->title }}</td>
                                    <td>
                                        @if($feature->status==1)
                                        <span class="badge badge-success" title="Active"> <i class="fa fa-check"></i> </span>
                                        @else
                                        <span class="badge badge-danger" title="Inactive"> <i class="fa fa-times"></i> </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <!-- Button trigger modal -->
                                            <button title="Edit Category" type="button" class="btn btn-info btn-xs"
                                                data-toggle="modal" data-target="#editCategory-{{ $feature->id }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <a class="btn btn-danger btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Category"
                                                                href="javascript:void(0)"
                                                                onclick='resourceDelete("{{ route('portfolio.features.destroy', $feature->id) }}")'>
                                                                <span class="delete-icon">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editCategory-{{ $feature->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                {!! Form::open(['method' => 'put', 'route' => ['portfolio.features.update', $feature->id],'files'=>true]) !!}
                                                <input type="hidden" name="portfolio_id" value="{{$data->id}}">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fs-5" id="exampleModalLabel">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Edit Feature
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label">Name:</label>
                                                            {!! Form::text('title', $feature->title, ['class' => 'form-control', 'placeholder' => 'Name','required']) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label"> Description : </label>
                                                            <textarea class="form-control" placeholder="Description" rows="4" name="description">{{$feature->description}}</textarea>
                                                        </div>
                                                        <div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
                                                            <label class="control-label"> Icon <span class="text-danger">*</span> : </label>
                                                            <div class="col-md-12">
                                                                <label class="post_upload" for="file-{{$feature->id}}" style="height: 100px;width: 100px;">
                                                                @if($feature->icon!=null)
                                                                <img id="image_load-{{$feature->id}}" src='{{imageRecover($feature->icon)}}' class="img-responsive">
                                                                @else
                                                                <img id="image_load-{{$feature->id}}" src="{{asset('assets/images/photo.png')}}">
                                                                @endif
                                                                </label>
                                                                {{Form::file('icon',array('id'=>'file-'.$feature->id,'style'=>'display:none','onchange'=>"photoLoad(this,'image_load-$feature->id')"))}}
                                                                 @if ($errors->has('icon'))
                                                                        <span class="help-block" style="display:block">
                                                                            <strong>{{ $errors->first('icon') }}</strong>
                                                                        </span>
                                                                    @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Status:</label>
                                                            {!! Form::select('status',[1=>'Active', 0 =>'Inactive'], $feature->status, ['class' => 'form-control','required']) !!}
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
    function getSlugFromString(str) {
    return str
        .toLowerCase()
        .replace(/[^a-z0-9-]/g, "-")
        .replace(/-+/g, "-")
        .replace(/^-|-$/g, "");
    }

    $("#addNewData [name='title']").keyup(function () {
    $("#addNewData [name='slug']").val(getSlugFromString(this.value));
    });
 </script>
@endpush

