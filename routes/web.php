<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

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
Route::get('/posts/{slug}', [PostController::class, 'show']);