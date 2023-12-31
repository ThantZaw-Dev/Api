<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Public Routes

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{search}', [ProductController::class, 'search']);

Route::post('/register', [UserApiController::class, 'register']);

Route::post('/login', [UserApiController::class, 'login']);






//Auth Routes
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('/products', [ProductController::class, 'store']);

    Route::put('/products/{id}', [ProductController::class, 'update']);

    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::post('/logout', [UserApiController::class, 'logout']);
});



