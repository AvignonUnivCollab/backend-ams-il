<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CategoryController;
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

//Home
Route::get('/', [DashboardController::class, 'statsAndCurrentUser'])->middleware('auth.custom')->name('dashboard');

//Rooms
Route::get('/living-room', [RoomController::class, 'index'])->middleware('auth.custom')->name('pages.living-room');
Route::post('/living-room', [RoomController::class, 'store'])->name('living-room.store');
Route::put('/living-room/{id}', [RoomController::class, 'update'])->name('living-room.update');

//Auth
Route::post('/login', [UserController::class, 'login'])->name('users.login');
Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');

//Users
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->middleware('auth.custom')->name('pages.user');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

//Category
Route::get('/category', [CategoryController::class, 'index'])->middleware('auth.custom')->name('pages.category');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

//Videos
Route::get('/videos', [VideoController::class, 'index'])->middleware('auth.custom')->name('pages.video');
Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');

//messages
Route::get('/messages', [MessageController::class, 'index'])->middleware('auth.custom')->name('pages.message');
