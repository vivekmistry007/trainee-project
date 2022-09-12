@extends('layouts.admin')
@section('title','VMS | comments')
@section('search')
<form action="{{url('comments_search')}}" id="target" method="get" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" name="search" id="search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>
@endsection
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Comments</h1>
</div>

<div class="col-xl-12 col-lg-10">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6></h6>
        </div>
        <div class="card-body">
            <div class="mx-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product</th>
                            <th>User</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    @foreach($comments as $c)
                    <tbody>
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->product->name}}</td>
                            <td>{{$c->user->name}}</td>
                            <td>{{$c->comment}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<div class="text-center">
</div>
@endsection