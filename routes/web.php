<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
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

/*
 |
 | LINK WEB PAGES
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


/*
 |
 | Controllers
 |
*/

Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');

//Users
Route::post('/register', [UserController::class, 'store'])->name('users.store');
Route::post('/login', [UserController::class, 'login'])->name('users.login');
