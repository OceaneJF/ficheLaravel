<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InputController;
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
