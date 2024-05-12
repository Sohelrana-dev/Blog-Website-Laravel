@extends('layouts.admin')
@section('content')
<div class="row">
 <div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-3">Profile Information Update</h4>
            <form role="form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ Auth()->user()->name }}">
                        @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email" value="{{ Auth()->user()->email }}">
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Old Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="old_password">
                        @error('old_password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        @if (session('pass_wrong_err'))
                            <strong class="text-danger">{{ session('pass_wrong_err') }}</strong>
                        @endif
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="inputPassword5" class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="inputPassword5" placeholder="Retype Password" name="password">
                        @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="justify-content-end row">
                    <div class="col-sm-9 d-flex justify-content-end">
                        <button type="submit" class="btn btn-info rounded-pill waves-effect waves-light">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
 <div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title mb-3">Profile Photo Update</h4>
            <form role="form" action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-3">
                    <label for="image" class="col-sm-3 col-form-label">Profile Photo</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" id="image" name="profile_photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('profile_photo')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <img class="mt-2" width="90" src="" id="blah" alt="">
                    </div>
                </div>
                <div class="justify-content-end row">
                    <div class="col-sm-9 d-flex justify-content-end">
                        <button type="submit" class="btn btn-info rounded-pill waves-effect waves-light">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@section('footer_content')
@if (session('pass_success'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('pass_success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
@if (session('profile_photo_update'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('profile_photo_update') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
@endsection
