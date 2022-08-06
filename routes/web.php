<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Author\AuthorDashboardController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//For Admin
Route::group(['as'=>'admin.','prefix' => 'admin', 'namespace' =>'Admin','middleware' => ['auth','admin']],function(){

    Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('dashboard');

});

//For Author
Route::group(['as'=>'author.','prefix' => 'author', 'namespace' =>'Author','middleware' => ['auth','author']],function(){
    Route::get('/dashboard',[AuthorDashboardController::class,'index'])->name('dashboard');
});