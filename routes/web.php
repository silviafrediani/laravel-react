<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

// auth
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts/{name?}', function () {
	return view('front.posts.index');
})->where('name', '[A-Za-z]+')->name('posts.index');


// admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
	
	Route::resource('users', App\Http\Controllers\Admin\UserController::class);

	Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');

	// admin posts
	Route::get('/posts', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('admin.posts.index');
	Route::get('/posts/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('admin.posts.create');
	Route::post('/posts/store', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('admin.posts.store');
	Route::get('/posts/edit/{post}', [App\Http\Controllers\Admin\PostController::class, 'edit'])->name('admin.posts.edit');
	Route::patch('/posts/update/{post}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('admin.posts.update');
	Route::delete('/posts/delete/{post}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('admin.posts.destroy');

	Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

});
