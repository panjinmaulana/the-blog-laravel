<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        // ini untuk menampilkan title by author / category
        $title = '';

        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }

        return view('posts', [
            'title' => 'All Posts' . $title,
            'active' => 'posts', // u/ menandakan navbar yang lagi active ketika di klik / dituju
            // 'posts' => Post::all(), manggil model class yang bernama Post, karena method all() itu static jadi pakai keyword '::'
            // keyword with() u/ menangani lazy loading karena itu merupakan default dari eloquent
            // jika pakai with() berarti memakai eager loading, jadi query nya dipanggil semuanya di awal u/ menghindari N+1 problem
            // normalnya ex: with('author'), jika single query
            // multiples pakai [] (array)
            // with()-nya dipindahkan di post controller
            'posts' => Post::latest()->filter(request(['search', 'category', 'author'])) // u/ menampilkan data yang terbaru
                ->paginate(7) // u/ pagination
                ->withQueryString(), // u/ melanjutkan query yang selanjutnya (pakai juga/tambah)
            // request() adalah method untuk mengambil apa yang ada pada url
            // kenapa filter([]) kenapa pakai array, karena akan mencari juga author, category selain title dan body
            // keyword filter() dapat dari query scope yang function public function scopeFilter (filter)
            // apa yang kita tuliskan di scopeFilter()
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
            'active' => 'posts',
            'post' => $post,
        ]);
    }
}
