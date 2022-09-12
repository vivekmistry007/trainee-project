<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Facade\FlareClient\Stacktrace\File;

class CustomerController extends Controller
{
    public function cpassword()
    {
        return view('customer.cpassword');
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
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalName();
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $name);
            $user->img = $name;
        }
            $user->update();
            return back()->with('status', 'Profile Updated!!');
    }
    public function dashboard()
    {   $product = Product::all()->count();
        return view('customer.dashboard',compact('product'));
    }

}
