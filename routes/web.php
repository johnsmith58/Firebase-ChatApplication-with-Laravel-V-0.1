<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chats', function(){
    return view('chat');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('chat/{auth_id}/{receive_id}', 'ChatController@index')->name('chat.index');
