@extends('layouts.customer')
@section('title','VMS | User Home Page')
@section('search')
<form action="{{url('product_customer_search')}}" id="target" method="get" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
                @foreach($products as $p)
                <div class="col-md-3 my-3 justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="{{asset('img/'.$p->img)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$p->name}}</h5>
                            <h6>{{$p->model}}</h6>
                            <p class="card-text">{{$p->description}}</p>
                            @if(empty( $p->comment ) || empty($p->ca_id))
                            <a class="btn btn-primary" onclick="showAddCommentModel({{$p->id}},{{ Auth::id() }})" id="openmodel">Add Comment</a>
                            @else
                            <a data-target="#exampleModal{{ $p->id }}" data-toggle="modal" class=" btn btn-primary">view Comment</a>
                            <div class="modal fade" id="exampleModal{{ $p->id }}" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"></button>
                                            <h4 class="modal-title">view Comment</h4>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Comment</label>
                                                <textarea class="form-control" name="description" readonly>{{ $p->comment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="modal fade" id="myModal" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"></button>
                            <h4 class="modal-title">Add Comment</h4>
                        </div>
                        <form id="useraddcommentform" type="post" action="{{ url('add-comment') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Comment</label>
                                    <textarea class="form-control" name="comment" id="message-text"></textarea>
                                    <input type="hidden" name="pro_id">
                                    <input type="hidden" name="ca_id">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>  

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function showAddCommentModel(pro_id, ca_id) {
        if (pro_id) {
            $('#useraddcommentform  input[name="pro_id"]').val(pro_id);
            $('#useraddcommentform  input[name="ca_id"]').val(ca_id);
        }
        $('#myModal').modal('show');
    }

    $('#useraddcommentform').on("submit", function(e) {

        e.preventDefault();
        var form = $('#useraddcommentform');
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(response) {
                console.log(response);
                if (response.status == true) {
         
                    location.reload();
        
                }
            }
        });
    });
</script>

@endsection