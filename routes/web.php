<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/',[
   'uses' => 'PagesController@home'
]);
Route::get('/about',[
    'uses' => 'PagesController@about'
]);
Route::get('/contact',[
    'uses' => 'TicketsController@create'
]);
//Ticket Route
Route::post('/contact',[
    'uses' => 'TicketsController@store'
]);
Route::get('/tickets',[
    'uses' => 'TicketsController@index'
]);
Route::get('/ticket/{slug?}', [
    'uses' => 'TicketsController@show'
]);
Route::get('/ticket/{slug?}/edit', [
    'uses' => 'TicketsController@edit'
]);
Route::post('/ticket/{slug?}/edit', [
    'uses' => 'TicketsController@update'
]);
Route::post('/ticket/{slug?}/delete', [
    'uses' => 'TicketsController@destroy'
]);
Route::post('/comment', [
    'uses' => 'CommentsController@newComment'
]);

Auth::routes();

Route::get('/home', 'HomeController@index');
