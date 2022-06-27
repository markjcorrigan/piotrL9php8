<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\PostCommentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\SiteController;



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

//Route::get('/', function () {
//    return view('home.index');
//});



//Route::get("notification", [SiteController::class, "showNotifications"]);

//Route::get('/homepiotr', [HomeController::class, 'home'])
//    ->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])
    ->name('home.contact');

Route::get('/', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home.index');

Route::get('/secret', [HomeController::class, 'secret'])
    ->name('secret')
    ->middleware('can:home.secret');

Route::get('/single', AboutController::class);


Route::resource('posts', PostsController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);

Route::get('/posts/tag/{tag}', [PostTagController::class, 'index'])->name('posts.tags.index');

Route::resource('posts.comments', PostCommentController::class)->only(['store']);
//Route::resource('users.comments', 'UserCommentController')->only(['store']);
//Route::resource('users', 'UserController')->only(['show', 'edit', 'update']);

//Route::get('mailable', function () {
//    $comment = App\Models\Comment::find(1);
//    return new App\Mail\CommentPostedMarkdown($comment);
//});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
