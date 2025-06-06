<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\FichierController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('base');
});

Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create')->middleware('auth');
    Route::post('/store', 'store')->name('store');
    Route::get('/{product}/edit', 'edit')->name('edit')->middleware('auth');
    Route::put('/{product}/update', 'update')->name('update');
    Route::delete('/{product}/destroy', 'destroy')->name('destroy')->middleware('auth');;
    Route::get('/{product}/show', 'show')->name('show');
    Route::get('/myProduct', 'showMyProducts')->name('myProduct');
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'doRegister']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/backoffice', [ProductController::class, 'backoffice'])->name('backoffice')->middleware(['auth', 'role:admin']);

Route::get('/meteo', [InputController::class, 'showInputForm'])->name('showInputForm');
Route::post('/meteo', [InputController::class, 'InputForm'])->name('InputForm');

Route::prefix("post")->group(function () {
    Route::get('/create', [PostController::class, 'showCreate'])->name('showCreate');
    Route::post('/create', [PostController::class, 'create'])->name('create');
    Route::get('/posts', [PostController::class, 'posts'])->name('posts');
});

Route::prefix("fichier")->group(function () {
    Route::get('/', [FichierController::class, 'index'])->name('fichier.index');
    Route::put('/create', [FichierController::class, 'create'])->name('fichier.create');
});

Route::prefix("lapin")->group(function () {
    Route::get('/{lapin}/edit', [AutoController::class, 'edit'])->name('lapin.index');
    Route::put('/{lapin}/update', [AutoController::class, 'update'])->name('lapin.update');
    Route::put('/{lapin}/lapin-update', [AutoController::class, 'autoUpdate'])->name('lapin.autoUpdate');
});
