@extends('layouts.admin')
@section('title','VMS | categories')
@section('search')
<form action="{{url('category_search')}}" id="target" method="get" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
    <h1 class="h3 mb-0 text-gray-800">All Categoreis</h1>
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
                            <th>Name</th>
                            <th>description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach($categories as $c)
                    <tbody>
                        <tr>
                            <td>{{$c->id}}</td>
                            <td>{{$c->name}}</td>
                            <td>{{$c->description}}</td>
                            <td>
                                <a href="{{url('admin/editcategory'.$c->id)}}" type="button" class="btn btn-info">Edit</a>
                                <button type="button" class="btn btn-danger" value="{{$c->id}}" data-toggle="modal" data-target="#deletemodal{{$c->id}}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <div class="text-center">
                    {{ $categories->links(); }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<!-- active Modal-->
@foreach($categories as $c)
<div class="modal fade" id="deletemodal{{$c->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Are you sure to Delete Category ?</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ url('delete'.$c->id) }}" method="post">
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