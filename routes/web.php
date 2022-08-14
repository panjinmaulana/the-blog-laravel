<?php

use Illuminate\Support\Facades\Route;

use App\Models\Category;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;

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
        'active' => 'home',
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'active' => 'about',
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
        'active' => 'categories',
        'categories' => Category::all(),
    ]);
});

// Route::get('/categories/{category:slug}', function(Category $category) {
//     return view('posts', [
//         'title' => "Post By Category : $category->name",
//         'active' => 'categories',
//         'posts' => $category->posts->load('category', 'author'),
//     ]);
// });

// Route::get('/authors/{author:username}', function(User $author) { :username nama aliasnya u/ author
//     return view('posts', [
//         'title' => "Post By Author : $author->name",
//         'active' => 'posts',

//         load() memakai teknik lazy eager loading
//         untuk menghindari N+1 problem
//         jadi posts diambil terlebih dahulu lalu load category & authornya
//         alur code-nya
//         ambil usernya siapa
//         ambil postsnya apa aja
//         ambil categorinya
//         ambil user buat yang lain, selain user yang dipilih
//         'posts' => $author->posts->load('category', 'author'),
//     ]);
// });

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest'); // name() merupakan Named Routes jadi routenya bisa kita kasih nama karena default Named Routes ketika user belum login untuk masuk ke URL tertentu bakalan di redirect ke yang nama route nya login yang ada di folder app/Htpp/Middleware/Authenticate.php method redirectTo(), middleware u/ mengauthentifikasi bahwa yang boleh masuk kesini hanya user yang belum login ('guest')
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function() {
    return view('dashboard.index');
})->middleware('auth');

// ini merupakan route resource CRUD (resource controller)
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth'); 