<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('post','homeController@index');
Route::get('post/{id}','homeController@show');
Route::get('province','homeController@provinces');
Route::get('province/{id}','homeController@userprovince');

Route::get('skills','homeController@skills');
Route::get('skills/{id}','homeController@userskills');





