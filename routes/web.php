<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SeetingsController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Author\AuthorDashboardController;
use App\Http\Controllers\Author\AuthorPostController;
use App\Http\Controllers\Author\AuthorSeetingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriberController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
Route::get('/',[HomeController::class,'index'])->name('home');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::post('subscriber',[SubscriberController::class,'store'])->name('subscriber.store');

//For Admin
Route::group(['as'=>'admin.','prefix' => 'admin','middleware' => ['auth','admin']],function(){

    Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('dashboard');

    Route::resource('tag', TagController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);

    Route::get('/pending/post',[PostController::class,'pending'])->name('post.pending');
    Route::put('/post/{id}/approve',[PostController::class,'approve'])->name('post.approve');
    //Subscriber Route
    Route::get('/subscriber',[AdminSubscriberController::class,'index'])->name('subscriber.index');
    Route::delete('/subscriber/{id}',[AdminSubscriberController::class,'destroy'])->name('subscriber.destroy');

    //Seetings Route
    Route::get('/settings',[SeetingsController::class,'index'])->name('settings');
    Route::put('/profileUpdate',[SeetingsController::class,'updateProfile'])->name('profile.update');
    Route::put('/updatePassword',[SeetingsController::class,'updatePassword'])->name('update.password');
});

//For Author


Route::group(['as'=>'author.','prefix' => 'author','middleware' => ['auth','author']],function(){
    Route::get('/dashboard',[AuthorDashboardController::class,'index'])->name('dashboard');
    Route::resource('post', AuthorPostController::class);

    //Seetings Route
    Route::get('/settings',[AuthorSeetingsController::class,'index'])->name('settings');
    Route::put('/profileUpdate',[AuthorSeetingsController::class,'updateProfile'])->name('profile.update');
    Route::put('/updatePassword',[AuthorSeetingsController::class,'updatePassword'])->name('update.password');
});