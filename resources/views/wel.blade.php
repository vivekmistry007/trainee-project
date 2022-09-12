@extends('layouts.customer')
@section('title','VMS | WELCOME')
@section('search')
<form action="{{url('home_search')}}" id="target" method="get" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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

<div class="col-xl-12 col-lg-10">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4>All products</h4>
        </div>
        <div class="card-body">
            <div class="row  text-center">
                @foreach($product as $p)
                <div class="col-md-3 my-3 justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset('img/'.$p->img)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$p->name}}</h5>
                            <h6>{{$p->model}}</h6>
                            <p class="card-text">{{$p->description}}</p>
                            <a class=" btn btn-primary" href="{{ route('login') }}">
                                Add Comment
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="paginetion">
                    {{ $product->links(); }}
                </div>
        </div>
    </div>
</div>
@endsection