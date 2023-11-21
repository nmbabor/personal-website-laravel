@extends('backend.master')

@section('title', 'Project Images')
@section('title_button')
    <a href="{{ route('portfolio.projects.index') }}" class="btn bg-gradient-primary">
        <i class="fas fa-list"></i>
        View All Projects
    </a>
@endsection

@section('content')
    <!-- card -->
    <div class="card">
        <!-- form start -->

        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        @foreach ($data->images as $image)
                            <div class="col-md-4">
                                <div class="card">
                                    <img style="height: 200px;" src="{{ imageRecover($image->image_path) }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div
                                                    class="py-1 custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input type="checkbox" value="1" class="custom-control-input myCheckbox"
                                                        id="publish-{{$image->id}}" data-id="{{$image->id}}" name="status" @if($image->status==1) checked @endif>
                                                    <label class="custom-control-label" for="publish-{{$image->id}}">
                                                        Publish
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-danger btn-xs float-right" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="Delete Category"
                                                    href="javascript:void(0)"
                                                    onclick='resourceDelete("{{ route('portfolio.projects.image-delete', $image->id) }}")'>
                                                    <span class="delete-icon">
                                                        <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 border-left">
                    <form action="{{ route('portfolio.projects.image-store') }}" method="post"
                        enctype="multipart/form-data" id="create-blog-form">
                        @csrf
                        <input type="hidden" name="portfolio_id" value="{{ $data->id }}">
                        <div class="form-group {{ $errors->has('thumbnail') ? 'has-error' : '' }}">
                            <label for="thumbnail">Add new image <span class="text-danger">*</span> : </label>
                            <div class="col-md-12 p-0">
                                <label class="post_upload" for="file">
                                    <!--  -->
                                    <img id="image_load" src="{{ asset('assets/images/photo.png') }}">
                                </label>
                                {{ Form::file('thumbnail', ['id' => 'file', 'style' => 'display:none', 'onchange' => "photoLoad(this,'image_load')"]) }}
                                @if ($errors->has('thumbnail'))
                                    <span class="help-block" style="display:block">
                                        <strong>{{ $errors->first('thumbnail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div
                                class="py-1 custom-control custom-switch custom-switch-off-danger custom-switch-on-success" >
                                <input type="checkbox"  value="1" class="custom-control-input" id="publish"
                                    name="status" checked>
                                <label class="custom-control-label" for="publish">
                                    Publish
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
    <!-- /.card -->
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.myCheckbox').change(function() {
                let isChecked = $(this).is(':checked');
                let id = parseInt($(this).attr('data-id'));
                let url = `{{route('portfolio.projects.image-update')}}?id=${id}&status=${isChecked?1:0}`;
                window.location.href = url;
            });
        });
    </script>
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
