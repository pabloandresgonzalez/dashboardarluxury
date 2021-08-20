<?php

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
    return redirect('login'); // view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Users

    Route::get('/user', [App\Http\Controllers\admin\UserController::class, 'index']);
    Route::get('/user/create', [App\Http\Controllers\Admin\UserController::class, 'create']);//form create
    Route::post('/user', [App\Http\Controllers\admin\UserController::class, 'store']);// envio form
    Route::get('/user/{user}/edit', [App\Http\Controllers\admin\UserController::class, 'edit']); //form edit
    Route::put('/user/{user}', [App\Http\Controllers\admin\UserController::class, 'update']);//envio form
    Route::get('/user/avatar/{filename?}', [App\Http\Controllers\admin\UserController::class, 'getImage'])->name('user.avatar');
    Route::get('/user/avatardoc/{filename?}', [App\Http\Controllers\admin\UserController::class, 'getImageDoc'])->name('user.avatardoc');

    //Route::delete('/user/{user}', [App\Http\Controllers\Admin\SpeciaUserControllerltyController::class, 'destroy']);

    //Users perfil
    Route::get('/user/indexperfil', [App\Http\Controllers\admin\UserController::class, 'indexperfil']);
    Route::put('/user/{user}/editperfil', [App\Http\Controllers\admin\UserController::class, 'editperfil']);//form edit
    // Route::post('/user', [App\Http\Controllers\admin\UserController::class, 'storeperfil']);// envio form







