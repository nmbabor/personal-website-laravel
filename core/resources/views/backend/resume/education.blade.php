@extends('backend.master')

@section('title', 'Education')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 border-right">
                    <fieldset>
                        <form action="{{ route('education.store') }}" method="post" id="addNewData">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12"> Qualification <span class="text-danger">*</span> : </label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Qualification" name="qualification">
                                    @error('qualification')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12"> Institute <span class="text-danger">*</span> : </label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Institute" name="institute">
                                    @error('institute')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12"> Passing Year <span class="text-danger">*</span> : </label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Ex: 2020" name="passing_year">
                                    @error('passing_year')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-md-12">Description : </label>
                                <div class="col-md-12">
                                    <textarea class="form-control" placeholder="Description" name="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12"> Result : </label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Pass" name="result">
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
                                <th>Qualification</th>
                                <th>Institute</th>
                                <th width="5%">Status</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allData as $data)
                                <tr>
                                    <td>{{ $data->qualification }}</td>
                                    <td>{{ $data->institute }}</td>
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
                                                                onclick='resourceDelete("{{ route('education.destroy', $data->id) }}")'>
                                                                <span class="delete-icon">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editData-{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                {!! Form::open(['method' => 'put', 'route' => ['education.update', $data->id]]) !!}
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fs-5" id="exampleModalLabel">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Edit Data
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="control-label">Qualification:</label>
                                                            {!! Form::text('qualification', $data->qualification, ['class' => 'form-control', 'placeholder' => 'Qualification','required']) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Institute:</label>
                                                            {!! Form::text('institute', $data->institute, ['class' => 'form-control', 'placeholder' => 'Institute','required']) !!}
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Passing year:</label>
                                                            {!! Form::text('passing_year', $data->passing_year, ['class' => 'form-control', 'placeholder' => 'Passing year','required']) !!}
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="control-label"> Description : </label>
                                                            <textarea class="form-control" placeholder="Description" name="description">{{$data->description}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Result:</label>
                                                            {!! Form::text('result', $data->result, ['class' => 'form-control', 'placeholder' => 'Result']) !!}
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