<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        return view('posts', [
            'title' => 'All Posts',
            // 'posts' => Post::all(), manggil model class yang bernama Post, karena method all() itu static jadi pakai keyword '::'
            // keyword with() u/ menangani lazy loading karena itu merupakan default dari eloquent
            // jika pakai with() berarti memakai eager loading, jadi query nya dipanggil semuanya di awal u/ menghindari N+1 problem
            // normalnya ex: with('author'), jika single query
            // multiples pakai [] (array)
            'posts' => Post::with(['author', 'category'])->latest()->get(), // u/ menampilkan data yang terbaru
        ]);
    }

    // cara manual tidak menggunakan route model binding
    // public function show($slug)
    // {
    //     return view('post', [
    //         'title' => 'Single Post',
    //         'post' => Post::find($slug),
    //     ]);
    // }

    public function show(Post $post) // menggunakan route model binding
    {
        return view('post', [
            'title' => 'Single Post',
            'post' => $post,
        ]);
    }
}
