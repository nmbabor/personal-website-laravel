@extends('backend.master')

@section('title', 'Add new portfolio')
@section('title_button')
    <a href="{{ route('portfolio.projects.index') }}" class="btn bg-gradient-primary">
        <i class="fas fa-list"></i>
        View All
    </a>
@endsection

@section('content')
    <!-- card -->
    <div class="card">
        <!-- form start -->
        <form action="{{ route('portfolio.projects.store') }}" method="post" enctype="multipart/form-data" id="create-blog-form">
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
                        <div class="form-group">
                            <label for="meta_description">
                                Used Technologies
                                <span class="text-danger">*</span> :
                            </label>
                            {{Form::select('technologies[]',$technologies,old('technologies')??'',['class'=>'form-control select2','multiple'])}}
                        </div>
                        <div class="form-group">
                            <label for="meta_description">
                                Meta Description
                                <span class="text-danger">*</span> :
                            </label>
                            <textarea class="form-control" placeholder="Enter short description for meta description" name="meta_description"
                                required cols="30" rows="4">{{ old('meta_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_tags">
                                Meta Tags :
                            </label>
                            <textarea class="form-control" placeholder="SPA,Hosting, ..." name="meta_tags">{{ old('meta_tags') }}</textarea>
                            <small class="form-text text-muted">Enter values separated by commas.</small>
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="portfolio_category_id">
                                Category
                                <span class="text-danger">*</span> :
                            </label>
                            {{Form::select('portfolio_category_id',$categories,'',['class'=>'form-control','placeholder'=>'Select Category', 'required'])}}
                        </div>
                        <div class="form-group">
                            <label for="client_name">
                                Client Name :
                            </label>
                            <input type="text" class="form-control" name="client_name" value="{{ old('client_name') }}" placeholder="nTech Bangla" />
                        </div>
                        <div class="form-group {{ $errors->has('thumbnail') ? 'has-error' : '' }}">
                            <label for="thumbnail"> Thumbnail <small>(1000 X 750px)</small> <span class="text-danger">*</span> : </label>
                            <div class="col-md-12 p-0">
                                <label class="post_upload" for="file">
                                    <!--  -->
                                    <img id="image_load" src="{{asset('assets/images/photo.png')}}">
                                </label>
                                {{Form::file('thumbnail',array('id'=>'file','style'=>'display:none','onchange'=>"photoLoad(this,'image_load')"))}}
                                 @if ($errors->has('thumbnail'))
                                        <span class="help-block" style="display:block">
                                            <strong>{{ $errors->first('thumbnail') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="project_date">
                                Project date :
                            </label>
                            <input type="text" class="form-control" name="project_date" value="{{ old('project_date') }}" placeholder="March, 2024 - December, 2024" />
                        </div>
                        
                        <div class="form-group">
                            <label for="live_url">
                                Live URL :
                            </label>
                            <input type="text" class="form-control" name="live_url" value="{{ old('live_url') }}" placeholder="www.example.com" />
                        </div>
                        <div class="form-group">
                            <label for="git_url">
                                Github URL :
                            </label>
                            <input type="text" class="form-control" name="git_url" value="{{ old('git_url') }}" placeholder="www.github.com/nmbabor/nmbabor" />
                        </div>
                        
                        <div class="form-group">
                            <label for="yt_video_id">
                                YT Video ID :
                            </label>
                            <input type="text" class="form-control" name="yt_video_id" value="{{ old('yt_video_id') }}" placeholder="4HSaYzMCA00" />
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
