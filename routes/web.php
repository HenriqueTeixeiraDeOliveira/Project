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

Route::get('/lessons/create','LessonsController@create');
Route::post('/lessons','LessonsController@store');
Route::get('/lessons/{id}','LessonsController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




/*
|   VERB            URI                     ACTION          ROUTE NAME
|   GET             /example                index           example.index
|   GET             /example/create         create          example.create
|   POST            /example                store           example.store
|   GET             /example/{id}           show            example.show
|   GET             /example/{id}/edit      edit            example.edit
|   PUT/PATCH       /example/{id)           update          example.update
|   DELETE          /example/(id)           destroy         example.destroy
*/