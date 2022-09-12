<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginate;
use Illuminate\Pagination\Paginator;    

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = category::paginate(6);
        return view('admin/categories' , compact('categories'));
    }
    
    public function store(Request $req)
    {
        $this->validate($req, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);
        $category = new Category;
        $category->name = $req['name'];
        $category->description = $req['description'];
        $category->save();
        return back()->with('status', 'Category Added successfully!!');  
    }

   
    public function display($id)
    {
        $category = Category::find($id);
        return view('admin/editcategory' , compact('category'));
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);
        $category = Category::find($id);
        $category->name = $req['name'];
        $category->description = $req['description'];
        $category->update();
        return redirect('admin/categories')->with('status', 'Category Edited successfully!!');  
    
    }
    
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('admin/categories')->with('status', 'Category Deleted successfully!!');    
    }
    public function category_search(Request $req){
          
        $search = $req->search;
        $categories = Category::where('name','Like','%'.$search.'%')->paginate(5);
        return view('admin.categories',compact('categories'));
    }
}

