<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        // ddd() u/ var_dump, die dan ngedebug

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts', // unique dari table posts
            'category_id' => 'required',
            'image' => 'image|file|max:1024', // max 1 mb
            'body' => 'required',
        ]);

        // cek apakah image di upload
        if ($request->file('image')) {
            // maka file image (dari name form di inputnya) simpan di store yang foldernya bernama post-images
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body, 200)); //strip_tags() u/ menghilangkan tags2 html, Str::limit() u/ text truncate, pada Str::limit() jika parameter yang ketiga ga diisi maka defaultnya adalah '...'

        // create ke db
        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // agar kita tidak bisa melihat dan mengubah post buatan author lain via URL
        if($post->author->id !== auth()->user()->id) {
            abort(403);
        }

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
    public function edit(Post $post) // model route binding, ini untuk update untuk ngambil datanya
    {
        // agar kita tidak bisa melihat dan mengubah post buatan author lain via URL
        if($post->author->id !== auth()->user()->id) {
            abort(403);
        }

        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) // ini untuk update datanya ke db, $request data baru inputan dari user, $post data lama dari db
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024', // max 1 mb
            'body' => 'required',
        ];

        // cek apakah image di upload
        if ($request->file('image')) {
            // maka file image (dari name form di inputnya) simpan di store yang foldernya bernama post-images
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        // cek apakah image di upload
        
        $validatedData = $request->validate($rules);
        
        if ($request->file('image')) {
            // cek ada img lama atau tidak
            if ($request->oldImage) {
                // untuk menghapus img pada storage
                Storage::delete($request->oldImage);
            }

            // maka file image (dari name form di inputnya) simpan di store yang foldernya bernama post-images
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body, 200)); //strip_tags() u/ menghilangkan tags2 html, Str::limit() u/ text truncate, pada Str::limit() jika parameter yang ketiga ga diisi maka defaultnya adalah '...'

        // update data ke db
        Post::where('id', $post->id)
                ->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // cek ada img lama atau tidak
        if ($post->image) {
            // untuk menghapus img pada storage
            Storage::delete($post->image);
        }

        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request) // $request ngambil dari URL, disini yang bernama title
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        // kembali kan dengan json array assoc
        return response()->json(['slug' => $slug]);
    }
}
