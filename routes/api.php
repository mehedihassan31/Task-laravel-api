<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PagesController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
// */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

    
// });


Route::group(['middleware'=>['auth:sanctum']], function () {

    Route::get('/test',[AuthController::class,"test"]);
    Route::post('/page/create',[PagesController::class,"create"]);

    //Create a post
    Route::post('/person/attach-post',[PostsController::class,"create"]);
    Route::post('/page/{pageId}/attach-post',[PostsController::class,"create"]);


});


Route::post('/register',[AuthController::class,"register"]);
Route::post('/login',[AuthController::class,"login"]);

