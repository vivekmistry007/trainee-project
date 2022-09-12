@extends('layouts.admin')
@section('title','VMS | customer')
@section('search')
<form action="{{url('customer_search')}}" id="target" method="get" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">All Customer's</h1>
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
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    @foreach($users as $u)
                    <tbody>
                        <tr>
                            <td>{{$u->id}}</td>
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->mobile}}</td>
                            <td>
                                @if($u->action == '1')
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#activemodal{{$u->id}}">
                                    Active
                                </button>
                                @else
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#demodal{{$u->id}}">
                                    Deactivate
                                </button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        {{ $users->links(); }}
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
<!-- active Modal-->
@foreach($users as $u)
<div class="modal fade" id="activemodal{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Are you sure to Deactivate ?</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Please Select 'deactivate' below button if you are ready.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                <a href="{{url('action'.$u->id)}}" class="btn btn-danger">Deactivate</a>

            </div>
        </div>
    </div>
</div>
<!-- deactive Modal-->
<div class="modal fade" id="demodal{{$u->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Are you sure to Activate ?</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Please Select 'Active' below button if you are ready.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                <a href="{{url('action'.$u->id)}}" class="btn btn-success">Active</a>

            </div>
        </div>
    </div>
</div>
@endforeach

@endsection