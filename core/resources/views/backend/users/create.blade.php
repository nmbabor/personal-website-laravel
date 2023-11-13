@extends('backend.master')

@section('title', 'Create User')
@section('title_button')
    <a href="{{ route('backend.admin.users') }}" class="btn bg-gradient-primary" >
        <i class="fas fa-list"></i>
        View All
    </a>
@endsection


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('backend.admin.user.create') }}" method="post" class="accountForm"
                enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" placeholder="Enter full name"
                                name="name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Login Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email"
                                value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="confirmPassword" class="form-label">Role & Permissions</label>
                            {{Form::select('type',['Admin'=>'Admin','User'=>'User'],'',['class'=>'form-control','placeholder'=>'Select Type', 'required'])}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password" class="form-label">Login password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password"
                                name="password" value="{{ old('password') }}" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="thumbnail">Profile Image</label>
                            <input type="file" class="form-control" name="profile_image"
                                onchange="previewThumbnail(this)">
                            <img class="img-fluid thumbnail-preview" src="{{ nullImg() }}" alt="preview-image">
                        </div>
                        <button type="submit" class="btn btn-block bg-gradient-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
