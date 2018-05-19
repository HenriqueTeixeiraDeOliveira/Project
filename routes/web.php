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
Route::get('/lessons/{channel}/{lesson}','LessonsController@show');
Route::delete('/lessons/{channel}/{lesson}', 'LessonsController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




/*
|   VERB            URI                     ACTION          ROUTE NAME
|   GET             /example                index           example.index
|   GET             /example/create         create          example.create
|   POST            /example                store           example.store
|   GET             /example/{key}          show            example.show
|   GET             /example/{key}/edit     edit            example.edit
|   PUT/PATCH       /example/{key}          update          example.update
|   DELETE          /example/{key}          destroy         example.destroy
*/

/*
|   VERB            URI                     ACTION          ROUTE NAME
|   GET             /example                index           example.index
|   GET             /example/create         create          example.create
|   POST            /example                store           example.store
|   GET             /example/{key}          show            example.show
|   GET             /example/{key}/edit     edit            example.edit
|   PUT/PATCH       /example/{key}          update          example.update
|   DELETE          /example/{key}          destroy         example.destroy
*/