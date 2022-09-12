@extends('layouts.admin')
@section('title','VMS | products')
@section('search')
<form action="{{url('product_search')}}" id="target" method="get" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
    <h1 class="h3 mb-0 text-gray-800">All products</h1>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Model</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach($products as $c)
                    <tbody>
                        <tr>
                            <td>{{$c->id}}</td>
                            <td><img src="{{asset('img/'.$c->img)}}" class="img"></td>
                            <td>{{$c->name}}</td>
                            <td>{{$c->category->name}}</td>
                            <td>{{$c->description}}</td>
                            <td>{{$c->model}}</td>
                            <td>{{$c->qty}}</td>
                            <td>
                                <a href="{{url('admin/editproduct'.$c->id)}}" type="button" class="btn btn-info">Edit</a>
                                <button type="button" class="btn btn-danger my-2" value="{{$c->id}}" data-toggle="modal" data-target="#deleteodal{{$c->id}}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <div class="paginetion">
                    {{ $products->links(); }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<!-- active Modal-->
@foreach($products as $c)
<div class="modal fade" id="deleteodal{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Are you sure to Delete product ?</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ url('prodelete'.$c->id) }}" method="post">
                @csrf
                @method('delete')
                <div class="modal-body">
                    Please Select 'Delete' below button if you are ready.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button name="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection