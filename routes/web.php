<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::middleware(['customer'])->group(function () {
    Route::get('/', [Controller::class, 'show'])->name('/');
    Route::get('home_search', [Controller::class, 'home_search'])->name('home_search');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('product_customer_search',[ProductController::class, 'product_customer_search'] )->name('product_customer_search');
    Route::post('add-comment', [CommentController::class, 'store'])->name('addcomment');
    Route::get('customer/cpassword',[CustomerController::class, 'cpassword'] )->name('customer.cpassword'); 
    Route::put('changepass',[CustomerController::class, 'change'] )->name('customer.cpassword'); 
    Route::put('customer/profileUpdate',[CustomerController::class, 'profileUpdate'] )->name('customer.profileUpdate');
    Route::get('customer/dashboard',[CustomerController::class, 'dashboard'] )->name('customer.dashboard');
    Route::get('action{id}',[CustomerController::class, 'action'] )->name('customer.action');
    Route::get('customer/profile', function () {
        return view('customer/profile');
    });
});


Route::middleware(['admin'])->group(function () {
    Route::get('admin/home',[HomeController::class, 'admin'] )->name('admin.home');
    Route::get('customer_search',[HomeController::class, 'customer_search'] )->name('customer_search');
    Route::get('category_search',[CategoriesController::class, 'category_search'] )->name('category_search');
    Route::get('product_search',[ProductController::class, 'product_search'] )->name('product_search');
    Route::get('comments_search',[CommentController::class, 'comments_search'] )->name('comments_search');
    Route::get('admin/cpassword',[HomeController::class, 'cpassword'] )->name('customer.cpassword'); 
    Route::put('changepass',[HomeController::class, 'change'] )->name('customer.cpassword'); 
     Route::put('admin/profileUpdate',[HomeController::class, 'profileUpdate'] )->name('admin.profileUpdate');
    Route::get('admin/customer',[HomeController::class, 'customer'] )->name('admin.customer');
    Route::get('action{id}',[HomeController::class, 'action'] )->name('admin.action');
    Route::get('admin/profile', function () {
        return view('admin/profile');
    });


    Route::get('admin/categories',[CategoriesController::class, 'index'] )->name('admin.categories');
    Route::get('admin/addcategory', function () {
        return view('admin/addcategory');
    });
    Route::post('addcategory',[CategoriesController::class, 'store'] )->name('admin.addcategory');
    Route::get('admin/editcategory{id}',[CategoriesController::class, 'display'] )->name('admin.editcategory');
    Route::put('editcategory{id}',[CategoriesController::class, 'update'] )->name('editcategory');
    Route::delete('delete{id}',[CategoriesController::class, 'destroy'] )->name('deletepage');


    Route::get('admin/products',[ProductController::class, 'index'] )->name('admin.products');
    Route::get('admin/addproduct',[ProductController::class, 'add'] )->name('admin.products');
    Route::post('addproduct',[ProductController::class, 'store'] )->name('admin.addproducts');
    Route::get('admin/editproduct{id}',[ProductController::class, 'display'] )->name('admin.editproducts');
    Route::put('editproduct{id}',[ProductController::class, 'update'] )->name('editproduct');
    Route::delete('prodelete{id}',[ProductController::class, 'destroy'] )->name('prodeletepage');


    Route::get('admin/comments',[CommentController::class, 'index'] )->name('comments');
});