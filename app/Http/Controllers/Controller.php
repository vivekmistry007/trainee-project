<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function show()
    {   
            $product = product::paginate(8);  
        return view('wel', compact('product'));
    }
    public function sh($id)
    {       
        $product = product::where('cate_id','=','$id')->get();  
        return view('wel', compact('product'));
    }
    public function home_search(Request $req){
          
        $search = $req->search;
        $products = Product::where('name','Like','%'.$search.'%')->paginate(5);
        return view('/',compact('products'));
    }
}
