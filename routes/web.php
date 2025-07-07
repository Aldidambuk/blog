<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home', ['title' => 'Home Page']);
});

Route::get('/posts', function () {
    // $posts = Post::with(['author', 'category'])->latest()->get();
    $posts = post::latest();

    if(request('search')){
        // fungsi keyword untuk menulis pencarian 
        $posts->where('title', 'like', '%' . request('search') . '%');
    }

    return view('posts', ['title' => 'Blog', 'posts' => $posts->get()]);
});
route::get('/posts/{post:slug}', function(post $post){
            return view('post',['title' => 'single post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function (User $user) {
    // $posts = $user->posts->load('category','author');
    return view('posts', ['title' => count($user->posts) . ' Article by. ' . $user->name, 'posts' => $user->posts]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    // $posts = $category->posts->load('category','author');
    return view('posts', ['title' => 'category:  ' . $category->name, 'posts' => $category->posts]);
});

Route::get('/About', function () {
    return view('About', ['title' => 'About']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'contact']);
});
