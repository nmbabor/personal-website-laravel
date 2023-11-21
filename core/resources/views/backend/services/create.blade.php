@extends('backend.master')

@section('title', 'Add new Services')
@section('title_button')
    <a href="{{ route('services.index') }}" class="btn bg-gradient-primary">
        <i class="fas fa-list"></i>
        View All
    </a>
@endsection

@section('content')
    <!-- card -->
    <div class="card">
        <!-- form start -->
        <form action="{{ route('services.store') }}" method="post" enctype="multipart/form-data" id="create-blog-form">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="title"> Title <span class="text-danger">*</span> : </label>
                            <input type="text" class="form-control" placeholder="Enter title" name="title"
                                value="{{ old('title') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="slug"> Slug <span class="text-danger">*</span> : </label>
                            <input type="text" class="form-control" placeholder="Link" name="slug"
                                value="{{ old('slug') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="meta_description">
                                Short Description
                                <span class="text-danger">*</span> :
                            </label>
                            <textarea class="form-control" placeholder="Enter short description for meta description" name="meta_description"
                                required rows="3">{{ old('meta_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">
                                Long Description
                                <span class="text-danger">*</span> :
                            </label>
                            <textarea class="form-control summerNote" placeholder="Enter long description" name="description" cols="30"
                                rows="10" id="content">{{ old('description') }}</textarea>
                            <p class="text-danger d-none" id="description-error">
                                * description field is required
                            </p>
                        </div>


                    </div>
                    <div class="col-md-3">
                        
                        <div class="form-group {{ $errors->has('icon') ? 'has-error' : '' }}">
                            <label for="icon"> Icon : </label>
                            <div class="col-md-12">
                                <label class="post_upload" for="file" style="height: 100px;width: 100px;">
                                    <!--  -->
                                    <img id="image_load" src="{{asset('assets/images/photo.png')}}">
                                </label>
                                {{Form::file('icon',array('id'=>'file','style'=>'display:none','onchange'=>"photoLoad(this,'image_load')"))}}
                                 @if ($errors->has('icon'))
                                        <span class="help-block" style="display:block">
                                            <strong>{{ $errors->first('icon') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon_class">Icon Class (If Need) : </label>
                            <input type="text" class="form-control" placeholder="Ex: bi bi-terminal" name="icon_class"
                                value="{{ old('icon_class')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="main-features">
                                Meta Tags :
                            </label>
                            <textarea class="form-control" placeholder="SPA,Hosting, ..." name="meta_tags">{{ old('meta_tags') }}</textarea>
                            <small class="form-text text-muted">Enter values separated by commas.</small>
                        </div>
                        <div class="form-group">
                            <div
                                class="py-1 custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" id="publish" name="status" checked>
                                <label class="custom-control-label" for="publish">
                                    Publish
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <!-- /.card -->
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

        $("[name='title']").keyup(function() {
            $("[name='slug']").val(getSlugFromString(this.value));
        });
    </script>
@endpush
