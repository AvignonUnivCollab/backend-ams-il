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


Route::get('/category', function () {
    return view('pages.category');
})->name('pages.category');


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

//Rooms
Route::get('/living-room', [RoomController::class, 'index'])->name('pages.living-room');
Route::post('/living-room', [RoomController::class, 'store'])->name('living-room.store');
Route::put('/living-room/{id}', [RoomController::class, 'update'])->name('rooms.update');

//Auth
Route::post('/login', [UserController::class, 'login'])->name('users.login');

//Users
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('pages.user');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

