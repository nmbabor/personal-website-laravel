@extends('backend.master')

@section('title', 'Link Submit Details')
@section('title_button')
<a href="{{ route('link-submit.index') }}" class="btn bg-gradient-primary">
    <i class="fas fa-list"></i>
    View All
</a>
@endsection

@section('content')
    <!-- card -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 pr-5">
                    <div class="form-group">
                        <label for="title"> Name : {{$data->title}} </label>
                    </div>
                    <div class="form-group">
                        <label for="content">
                            Links:
                        </label>
                        <textarea class="form-control" name="links" cols="30" rows="10"
                            id="json-load">{{ $links}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="title"> Status : @if($data->status==1) <span class="text-success">Success</span> @else <span class="text-danger">Faild</span> @endif </label>
                    </div>
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>

            </div>
    </div>
    <!-- /.card -->
@endsection

@push('script')
    <script>
        document
            .getElementById("create-blog-form")
            .addEventListener("submit", function(event) {
                var contentValue = document.getElementById("description").value;

                if (contentValue.trim() === "") {
                    event.preventDefault();

                    // Throw an exception or display an error message
                    document.getElementById("description-error").classList.remove("d-none");
                }
            });

            function getSlugFromString(str) {
                return str
                    .toLowerCase()
                    .replace(/[^a-z0-9-]/g, "-")
                    .replace(/-+/g, "-")
                    .replace(/^-|-$/g, "");
                }

                $("[name='title']").keyup(function () {
                    $("[name='slug']").val(getSlugFromString(this.value));
                });
    </script>
@endpush
