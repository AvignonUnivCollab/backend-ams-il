<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/user', function () {
    return view('pages.user');
})->name('pages.user');

Route::get('/category', function () {
    return view('pages.category');
})->name('pages.category');

Route::get('/living-room', function () {
    return view('pages.living-room');
})->name('pages.living-room');

Route::get('/login', function () {
    return view('pages.login');
})->name('pages.login');

Route::get('/register', function () {
    return view('pages.register');
})->name('pages.register');
