<?php

use App\Http\Controllers\Api\Post; // Make sure the namespace and class name are correct
use App\Http\Controllers\Api\Postcontroller;
use App\Http\Controllers\Api\Usercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('posts', [Postcontroller::class, 'index']);

Route::put('posts/edit/{post}', [Postcontroller::class, 'update']);
Route::delete('posts/{post}', [Postcontroller::class, 'delete']);
Route::post('/register', [Usercontroller::class, 'register']);
Route::post('/login', [Usercontroller::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('posts/create', [Postcontroller::class, 'store']);
    Route::get('/user', function(Request $request){
        return $request->user;
    });
});
