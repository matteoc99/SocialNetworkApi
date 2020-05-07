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


Route::apiResource('/user', 'UserController');
Route::apiResource('/role', 'RoleController');
Route::delete('/user/friends/{user}/{friend}', 'UserController@removeFriend');
Route::get('/user/friends/{user}', 'UserController@friends');

Route::post('/login','Auth\LoginController@login');

Route::group(['middleware'=>'auth'],function (){

    Route::get('/role/{role}/user', 'RoleController@showUser');

});
