<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home', ['title' => 'Home Page']);
});

Route::get('/posts', function () {
    // fungsi untuk search, category, author, dan pagination untuk pindah halaman post 
    // dan withQueryString untuk tetap berada di halaman atau rute kita masuk atau klik(misal di category web programing)
    $posts = post::latest()->Filter(request(['search','category','author']))->paginate(5)->withQueryString();
    return view('posts', ['title' => 'Blog', 'posts' => $posts]);
});
route::get('/posts/{post:slug}', function(post $post){
            return view('post',['title' => 'single post', 'post' => $post]);
});


Route::get('/About', function () {
    return view('About', ['title' => 'About']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'contact']);
});
