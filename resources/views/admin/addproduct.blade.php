@extends('layouts.admin')
@section('title','VMS | addproduct')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
</div>
<div class="col-xl-12 col-lg-10">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6></h6>
        </div>
        <div class="card-body">
            <div class="mx-5">
                <form action="{{url('addproduct')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Category : </label>
                        <div class="col-md-6">
                            <select name="category" id="category" class="form-control  @error('category') is-invalid @enderror">
                                <option value="">Select a Category</option>
                                @foreach($category as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">Name : </label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">Model : </label>

                        <div class="col-md-6">
                            <input id="Model" type="text" class="form-control @error('Model') is-invalid @enderror" name="Model" >

                            @error('Model')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">Quantity : </label>

                        <div class="col-md-6">
                            <input id="Quantity" type="number" class="form-control @error('Quantity') is-invalid @enderror" name="Quantity" >

                            @error('Quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-right">description : </label>

                        <div class="col-md-6">
                            <textarea id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="3" autocomplete="description">
                                </textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="img" class="col-md-3 col-form-label text-md-right">Image : </label>

                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control @error('Image') is-invalid @enderror" name="image" >
    
                            {!!$errors->first('image', '<span class="text-danger">:message</span>')!!}

                        </div>
                    </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md offset-md-5">
                    <button id="sub" name="submit" type="submit" class="btn btn-primary">
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