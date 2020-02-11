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
use Illuminate\Support\Facades\Route;

Route::get('/', 'ProfileController@index')->name('inicio');
Route::get('/mytweets', 'TweetsController@index')->name('myTweets');
Route::get('/megusta', 'FavoriteController@favorites')->name('meGusta');
Route::get('/seguidores', 'ContactsController@seguidores')->name('misSeguidores');
Route::get('/siguiendo', 'ContactsController@siguiendo')->name('misSeguidos');
Route::post('/borrarTweets', 'TweetsController@borrarTweets')->name('borrarTweets');
Route::post('/borrarFavoritos', 'FavoriteController@borrarFavoritos')->name('borrarFavoritos');

Route::get('/prueba', 'PruebaController@getPrueba')->name('prueba');