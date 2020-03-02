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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::resource('hp_images', 'HpImagesController');
Route::get('hp_images/favorites', 'HpImagesController@favorites')->middleware('auth');

Route::get('hp_images', 'HpImagesController@index')->middleware('auth');

Route::get('hp_images/message', 'HpImagesController@show')->middleware('auth');

Route::get('hp_images/favorite', 'HpImagesController@favorite')->middleware('auth');

Route::post('hp_images', 'HpImagesController@store')->middleware('auth');