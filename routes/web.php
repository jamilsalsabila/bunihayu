<?php

use App\Http\Controllers\Product;
use App\Http\Controllers\Userlogin;
use App\Http\Controllers\Fasilitas;
use App\Http\Controllers\Gallery;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Landing;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\UserRegister;
use App\Http\Controllers\Search;
use App\Http\Controllers\UserComments;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ContactUs;

//Route::get('admin', [Admin::class, 'index']);

/*
RUTE LANDING PAGE
*/
Route::get('/', [Landing::class, 'index'])->name('home');

/*
RUTE PRODUK
*/
Route::get('product', [ProductController::class, 'index'])->middleware('auth');
Route::get('product/create', [ProductController::class, 'create'])->middleware('onlyadmin');
Route::post('product', [ProductController::class, 'save'])->middleware('onlyadmin');
Route::get('product/show/{id}', [ProductController::class, 'show']);
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->middleware('onlyadmin');
Route::patch('product', [ProductController::class, 'update'])->middleware('onlyadmin');
Route::delete('product', [ProductController::class, 'delete'])->middleware('onlyadmin');

/*
RUTE LOGIN, LOGOUT
*/
Route::get('login', [Userlogin::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [Userlogin::class, 'signin'])->middleware('guest');
Route::get('logout', [Userlogin::class, 'signout'])->middleware('auth');

/*
RUTE REGISTER
*/
Route::get('register', [UserRegister::class, 'get'])->middleware('guest');
Route::post('register', [UserRegister::class, 'post'])->middleware('guest');


/*
RUTE SEARCH
*/
Route::get('search', [Search::class, 'index'])->middleware('auth');
Route::post('search', [Search::class, 'query'])->middleware('auth');

/*
RUTE COMMENTS
*/
Route::post('product/show/{id}', [UserComments::class, 'add']);


/*
RUTE GALLERY
*/
Route::get('gallery', [Gallery::class, 'add'])->middleware('onlyadmin');
Route::post('gallery', [Gallery::class, 'save'])->middleware('onlyadmin');
Route::get('gallery/edit/{id}', [Gallery::class, 'edit'])->middleware('onlyadmin');
Route::patch('gallery', [Gallery::class, 'saveedit'])->middleware('onlyadmin');
Route::delete('gallery', [Gallery::class, 'delete'])->middleware('onlyadmin');

/*
RUTE FASILITAS 
*/
Route::get('fasilitas', [Fasilitas::class, 'add'])->middleware('onlyadmin');
Route::post('fasilitas', [Fasilitas::class, 'save'])->middleware('onlyadmin');
Route::get('fasilitas/edit/{id}', [Fasilitas::class, 'edit'])->middleware('onlyadmin');
Route::patch('fasilitas', [Fasilitas::class, 'saveedit'])->middleware('onlyadmin');
Route::delete('fasilitas', [Fasilitas::class, 'delete'])->middleware('onlyadmin');


/*
RUTE Contact Us
*/
Route::post('contactus', function (Request $request) {
    $data = [
        'subject' => 'Pesan dari pengunjung',
        'nama' => $request->input('nama'),
        'hp' => $request->input('hp'),
        'email' => $request->input('email'),
        'pesan' => $request->input('pesan'),
    ];

    Mail::to("msalsabilajamil@gmail.com")->send(new ContactUs($data));
    return redirect(url('/#contactus'))->with("contactUsSuccess", "terima kasih atas pesannya");
});