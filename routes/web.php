<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;
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

Route::get('/', function () {
    return view('home', [
        'title' => 'Home',
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'name' => 'Panji Maulana',
        'email' => 'panjinmaulana@gmail.com',
        'image' => 'panji.jpg',
    ]);
});

// memanggil class PostController yang mempunyai method index
Route::get('/posts', [PostController::class, 'index']);

// memanggil class PostController yang mempunyai method show
// halaman single post
// {slug} mengambil apapun yang ada di dalamnya. u/ bisa digunakan (diolah) kembali

// keyword ':slug' berarti akan mencari slugnya itu sendiri, karena default dari slug itu id
// dan ketika pakai seperti itu di controller tidak perlu ada logic find slug, jadi cukup di route nya saja
// karena sudah memakan route model binding
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function() {
    return view('categories', [
        'title' => 'Post Categories',
        'categories' => Category::all(),
    ]);
});

Route::get('/categories/{category:slug}', function(Category $category) {
    return view('category', [
        'title' => $category->name,
        'posts' => $category->posts,
        'category' => $category->name,
    ]);
});