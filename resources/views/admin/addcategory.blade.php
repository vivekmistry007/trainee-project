@extends('layouts.admin')
@section('title','VMS | addcategory')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Category</h1>
</div>
<div class="col-xl-12 col-lg-10">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6></h6>
        </div>
        <div class="card-body">
            <div class="mx-5">
                <form action="{{url('addcategory')}}" method="post">
                    @csrf
                    <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Name : </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">description : </label>

                            <div class="col-md-6">
                                <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description"  rows="3" required autocomplete="description">
                                </textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        </div> <div class="form-group row mb-0">
                            <div class="col-md offset-md-5" >
                                <button id="sub" type="submit" class="btn btn-primary">
                                     Submit
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection