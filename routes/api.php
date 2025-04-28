<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\RoomController;
use App\Http\Controllers\api\UserRoomController;
use App\Http\Controllers\api\PlaylistController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use L5Swagger\Http\Controllers\SwaggerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/docs', [SwaggerController::class, 'api'])->name('l5-swagger.api');


Route::middleware('auth:jwt')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware(['cors'])->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::post('/check-email', [AuthController::class, 'checkEmail'])->middleware('throttle:5,1');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->middleware('throttle:5,1');

    Route::middleware('auth:jwt')->group(function () {
        Route::get('categories', [CategoryController::class, 'index'])->middleware('throttle:5,1');
        Route::get('/categories/{id}', [CategoryController::class, 'show'])->middleware('throttle:5,1');
        Route::get('/user-rooms', [UserRoomController::class, 'rooms_join'])->middleware('throttle:5,1');
        Route::get('/videos/{roomId}', [VideoController::class, 'index'])->middleware('throttle:5,1');

        //Room
        Route::get('/rooms', [RoomController::class, 'index'])->middleware('throttle:5,1');
        Route::post('/room/{roomId}/leave', [RoomController::class, 'leave'])->middleware('throttle:5,1');
        Route::post('room/{roomId}/join', [RoomController::class, 'join'])->middleware('throttle:5,1');
        Route::get('/rooms/{roomId}', [RoomController::class, 'show'])->middleware('throttle:5,1');

        //Message
        Route::post('/send-message/{roomId}', [MessageController::class, 'store'])->middleware('throttle:5,1');
        Route::get('/messages/{roomId}', [MessageController::class, 'index'])->middleware('throttle:5,1');

        Route::get('/me', [AuthController::class, 'me'])->middleware('throttle:5,1');

        //Playlist
        Route::get('/playlists', [PlaylistController::class, 'index'])->middleware('throttle:5,1');
        Route::get('/playlists/{roomId}', [PlaylistController::class, 'getPlaylistByRoom'])->middleware('throttle:5,1');
        Route::post('/playlists/add-video/{roomId}', [PlaylistController::class, 'addVideoToPlaylist'])->middleware('throttle:5,1');
        Route::post('/playlists/remove-video/{playlistVideoId}', [PlaylistController::class, 'removeVideoFromPlaylist'])->middleware('throttle:5,1');
    });


});