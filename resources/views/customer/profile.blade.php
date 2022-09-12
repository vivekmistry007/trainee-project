@extends('layouts.customer')
@section('title','VMS | Customer Profile')
@section('content')

<link rel="stylesheet" href="{{asset('css/pro.css')}}">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile</h1>
</div>
<div class="col-xl-12 col-lg-10">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6>{{Auth::user()->name}}'s Profile</h6>
        </div>
        <div class="card-body">
            <div class="mx-5">
                <form action="{{url('customer/profileUpdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="container">
                        <div class="picture-container m-5">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                            <div id="profile-container" class="text-center">
                                <image id="profileImage" src="{{asset('img/'.Auth::user()->img)}}" class="img rounded" />
                                <input id="imageUpload" type="file" name="image" placeholder="Photo"  capture>
                                {!!$errors->first('image', '<span class="text-danger">:message</span>')!!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">Name : </label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->name}}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right">E-Mail Address : </label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email}}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-md-3 col-form-label text-md-right">Mobile : </label>

                        <div class="col-md-6">
                            <input id="mobile" type="mobile" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ Auth::user()->mobile }}" required autocomplete="mobile">

                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md offset-md-5">
                            <button id="sub" type="submit" class="btn btn-primary">
                                Update Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#profileImage").click(function(e) {
        $("#imageUpload").click();
    });

    function fasterPreview(uploader) {
        if (uploader.files && uploader.files[0]) {
            $('#profileImage').attr('src',
                window.URL.createObjectURL(uploader.files[0]));
        }
    }

    $("#imageUpload").change(function() {
        fasterPreview(this);
    });
</script>

@endsection