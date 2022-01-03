<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Protect (authentication)
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::put('/articles/{id}', [ArticleController::class, 'update']);
   
});

Route::group(['middleware' => ['auth:sanctum', 'role']], function() {
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
});

//Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/articles/search/{title}', [ArticleController::class, 'search']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::get('/articles', [ArticleController::class, 'index']);