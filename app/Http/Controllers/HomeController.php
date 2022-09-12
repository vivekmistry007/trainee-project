<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use \stdClass;
use App\Rules\MatchOldPassword;
use Egulias\EmailValidator\Warning\Comment as WarningComment;
use Illuminate\Support\Facades\Hash;

use Illuminate\Pagination\Paginator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        $userData = Auth::user();
        $products = Product::all();
        $array = [];
        foreach($products as $product){
            $poll = new stdClass;
            $poll->id = $product->id;
            $poll->name = $product->name;
            $poll->model = $product->model;
            $poll->description = $product->description;
            $poll->qty = $product->qty;
            $poll->img = $product->img;
            $poll->cate_id = $product->cate_id;
            $comments = Comment::where(['pro_id' =>$product->id])->where(['ca_id' => $userData->id])->first();
            if($comments){
                $poll->comment = $comments->comment;
                $poll->ca_id = $comments->ca_id;
            }else{
                $poll->comment = '';
                $poll->ca_id = '';
            }
            array_push($array, $poll);
        }
            $container['products'] = $array;
        //  dd($container);
        return view('home',$container);
    }
   
    public function admin()
    {
        $user = User::where('is_admin','0')->count();
        $product = Product::all()->count();
        $categories = Category::all()->count();
        $comment = Comment::all()->count();
        return view('admin.home', compact('user','product','categories','comment'));
    }
    public function cpassword()
    {
        return view('admin.cpassword');
    }
    public function change(Request $request)
    {

        $request->validate([
            'oldpass' => ['required', new MatchOldPassword],
            'newpass' => ['required'],
            'conpass' => ['same:newpass'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->newpass)]);
           
        return back()->with('status', 'Password Updated!!');
        
        
    }
    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => 'required|regex:/^[6-9]{1}[0-9]{9}$/|min:9',
        ]);
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->mobile = $request['mobile'];
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            $path = 'img/'.$user->img;
            if (File::exists($path))
            {
                File::delete($path);
            }
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalName();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $name);
            $user->img = $name;
        }
            $user->update();
            return back()->with('status', 'Profile Updated!!');
    }
    public function customer(Request $req)
    { 
        $users = User::where('is_admin','=',0)->paginate(7);
        $users = compact('users');
        return view('admin.customer')->with($users);
    }
    public function customer_search(Request $req){
          
        $search = $req->search;
        $users = User::where('name','Like','%'.$search.'%')->paginate(5);
        return view('admin.customer',compact('users'));
    }
    public function action($id)
    {   
        $user = user::find($id);
        if($user->action == '1'){
            $action='0';
        }else{
            $action='1';
        }
       $user->action = $action;
       $user->update();
       if( $user->action == '1'){
           return back()->with('status', $user->name.' is activeted !!');
       }else{
            return back()->with('status', $user->name.' is deactivated !!');
        }
       
    }
}
