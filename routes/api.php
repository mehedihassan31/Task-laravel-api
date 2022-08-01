<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PagesController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\FollowController;
use App\Http\Controllers\Api\FeedController;


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

    //Create a page
    Route::post('/page/create',[PagesController::class,"create"]);

    //Create a post
    Route::post('/person/attach-post',[PostsController::class,"create"]);
    Route::post('/page/{pageId}/attach-post',[PostsController::class,"create"]);

    //follow
    Route::post('/follow/person/{personId}',[FollowController::class,"toFollow"]);
    Route::post('/follow/page/{pageId}',[FollowController::class,"toFollowPage"]);

    //feed
    Route::get('/person/feed',[FeedController::class,"getFeedData"]);
});

// Route for login and register a new user
Route::post('/auth/register',[AuthController::class,"register"]);
Route::post('/auth/login',[AuthController::class,"login"]);

