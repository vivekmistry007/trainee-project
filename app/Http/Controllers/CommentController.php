<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Http\JsonResponse;


class CommentController extends Controller
{
    public function index()
    {
        $comments = comment::all();
        return view('admin/comments', compact('comments'));
    }
    public function store(Request $req)
    {
        $comment = Comment::where('ca_id',$req->ca_id)->where('pro_id',$req->pro_id)->first();
        if(!empty($comment)){
            $comment->delete();
        }
        $data = new Comment();
        $data->comment = $req->comment;
        $data->pro_id = $req->pro_id;
        $data->ca_id = $req->ca_id;
        $data->save();

        $container['status'] = true;
        return new JsonResponse($container);
       
       
    }
    public function comments_search(Request $req){
          
        $search = $req->search;
        $comments = Product::where('name','Like','%'.$search.'%')->paginate(5);
        return view('admin.comments',compact('comments'));
    }
   
}
