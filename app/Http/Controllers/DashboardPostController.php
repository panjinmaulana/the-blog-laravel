<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;

// CRUD
// controller ini normalnya (awalnya) disediakan oleh laravelnya
// dengan menggunakan Resource Controller
// syntax di terminal, ex: php artisan make:controller DashboardPostController --resource --model=Post
// command valet CTRL+SHIFT+P -> pilih artisan make:controller -> tentukan nama controllernya -> pilih resource -> pilih yes -> tentukan nama modelnya

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ini halaman awal, otomatis akan dipanggil lebih awal ketika kita tidak memanggil methodnya

        return view('dashboard.posts.index', [
            // mengambil post user yang login
            'posts' => Post::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // untuk mengambil data dari yang diinputkan user (create data)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function checkSlug(Request $request) // $request ngambil dari URL, disini yang bernama title
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        // kembali kan dengan json array assoc
        return response()->json(['slug' => $slug]);
    }
}
