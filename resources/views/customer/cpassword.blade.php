@extends('layouts.customer')
@section('title','VMS | change password')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
</div>
<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                </div>
                <div class="card-body">
                <form action="{{url('changepass')}}" method="post">
                    @csrf
                    @method('put')
                    <label for="password">Old Password :</label>
                    <div class="col-md-6">
                            <input id="oldpass" type="password" class="form-control @error('oldpass') is-invalid @enderror" name="oldpass" >

                            @error('oldpass')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    <label for="password">New Password :</label>
                    <div class="col-md-6">
                            <input id="newpass" type="password" class="form-control @error('newpass') is-invalid @enderror" name="newpass" >

                            @error('newpass')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    <label for="password">Confirm Password :</label>
                    <div class="col-md-6">
                            <input id="conpass" type="password" class="form-control @error('conpass') is-invalid @enderror" name="conpass">

                            @error('conpass')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    <button class="btn btn-primary m-4" id="submit">Change</button>
                </form>                
            </div>
        </div>
    </div>

    @endsection