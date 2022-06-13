<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

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

Route::fallback(fn() => response()->json([
    'error' => 'No matching route was found. Next season you\'ll find OpenApi docs'], HttpFoundationResponse::HTTP_NOT_FOUND)
);

Route::group(['prefix' => 'user', 'namespace' => 'App\Http\Controllers\Auth\\'], function () {
    Route::post('register', 'RegisterController@register');
    Route::post('auth', 'AuthController@auth');
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::patch('profile', 'ProfileController@change');
    });

});
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
