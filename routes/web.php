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

Route::get('/todo', function () {
    return view('todo.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('lists', 'TodolistController')->middleware('auth');
Route::get('/lists/{id}/delete', 'TodolistController@confirmDelete')->middleware('auth');

Route::resource('lists/{list}/items', 'TodolistitemController')->middleware('auth');
Route::get('/lists/{list}/items/{item}/delete', 'TodolistitemController@confirmDelete')->middleware('auth');
