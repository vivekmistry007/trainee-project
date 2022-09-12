<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = product::paginate(7);
        return view('admin/products', compact('products'));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'category' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'description' => 'required',
            'Model' => 'required',
            'Quantity' => 'required',
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $product = new Product();
        $product->cate_id = $req['category'];
        $product->name = $req['name'];
        $product->description = $req['description'];
        $product->model = $req['Model'];
        $product->qty = $req['Quantity'];
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $name = time() . '.' . $image->getClientOriginalName();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $name);
            $product->img = $name;
        }
        $product->save();
        return back()->with('status', 'Product Added successfully!!');
    }
    public function add()
    {
        $category = category::all();
        return view('admin/addproduct', compact('category'));
    }

    public function display($id)
    {
        $category = category::all();
        $product = product::find($id);
        return view('admin/editproduct', compact('product', 'category'));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'category' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'description' => 'required',
            'Model' => 'required',
            'Quantity' => 'required',
        ]);
        $product = Product::find($id);
        $product->cate_id = $req['category'];
        $product->name = $req['name'];
        $product->description = $req['description'];
        $product->model = $req['Model'];
        $product->qty = $req['Quantity'];
        if ($req->hasFile('image')) {
            $this->validate($req, [
                'image' =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            $path = 'img/' . $product->img;
            $image = $req->file('image');
            $name = time() . '.' . $image->getClientOriginalName();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $name);
            $product->img = $name;
        }
        $product->update();
        return back()->with('status', 'Product Updated successfully!!');
    }

    public function destroy($id)
    {
        $product = product::find($id);
        $product->delete();
        return back()->with('status', 'Product Deleted successfully!!');
    }
    public function product_search(Request $req){
          
        $search = $req->search;
        $products = Product::where('name','Like','%'.$search.'%')->paginate(5);
        return view('admin.products',compact('products'));
    }
    public function product_customer_search(Request $req){
          
        $search = $req->search;
        $products = Product::where('name','Like','%'.$search.'%')->paginate(5);
        return view('home',compact('products'));
    }
   
}
