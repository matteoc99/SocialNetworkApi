<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//web stuff
Route::get('/',function (){
    return "<div style='width: 100%;text-align: center'>
                <h1>Nothing to see here, API only</h1>
                <a href='/doc'>API - documentation</a>
            </div>";
});
Route::get('/doc',"Web\DocController@doc");
Route::get('/apidoc.json',"Web\DocController@postman")->name("apidoc.json");



//token stuff, no auth needed
Route::post('/login','Auth\LoginController@login');
Route::get('/login','Auth\LoginController@loginRequired')->name("login");
Route::post('/register','Auth\LoginController@register');

//password reset, without auth
Route::post('/reset', 'Auth\PasswordResetController@reset');
Route::post('/reset/create', 'Auth\PasswordResetController@create');


Route::group(['middleware'=>['auth']],function (){
    //authentication required routes
    Route::get('/user', 'UserController@index');

    Route::get('/refresh','Auth\LoginController@refresh');

    Route::delete('/friends/{friend}', 'FriendshipController@removeFriend');
    Route::get('/friends', 'FriendshipController@friends');
    Route::get('/friends/location', 'FriendshipController@friendsLocation');
    Route::post('/requestFriend/{friend}', 'FriendshipController@requestFriend');
    Route::get('/friendrequests', 'FriendshipController@friendrequests');
    Route::get('/pendingfriendrequests', 'FriendshipController@pendingfriendrequests');
    Route::post('/acceptFriend/{friend}', 'FriendshipController@acceptFriend');

    Route::get('/posts', 'PostController@index');
    Route::post('/post', 'PostController@store');
    Route::get('/postfeed', 'PostController@postfeed');


    // Route::get('/comments/{post}', 'CommentController@commentsOfPost');
    //Route::post('/comment/{post}', 'CommentController@store');
    //Route::post('/comment/{post}/{comment}', 'CommentController@storeNested');

    Route::get('/suggestions', 'UserController@suggestions');

});

Route::group(['middleware'=>['auth', 'editor']],function (){

});
Route::group(['middleware'=>['auth', 'admin']],function (){
    Route::get('/user', 'UserController@index');

});
