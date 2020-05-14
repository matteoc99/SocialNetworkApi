<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::group(['middleware'=>'cors'],function (){

//token stuff, no auth needed
Route::post('/login','Auth\LoginController@login');
Route::get('/login','Auth\LoginController@loginRequired')->name("login");
Route::post('/register','Auth\LoginController@register');
Route::post('/test','Auth\LoginController@test');
//});

//password reset
Route::post('/reset', 'Auth\PasswordResetController@reset');
Route::post('/reset/create', 'Auth\PasswordResetController@create');


Route::group(['middleware'=>['auth']],function (){
    //authentication required routes

    Route::get('/refresh','Auth\LoginController@refresh');

    Route::delete('/friends/{friend}', 'UserController@removeFriend');
    Route::get('/friends', 'UserController@friends');
    Route::get('/friends/location', 'UserController@friendsLocation');
    Route::get('/role/{role}/user', 'RoleController@showUser');

    Route::get('/user', 'UserController@index');

});

Route::group(['middleware'=>['auth', 'editor']],function (){
    //editor only routes

});
Route::group(['middleware'=>['auth', 'admin']],function (){
    //admin only routes

});
