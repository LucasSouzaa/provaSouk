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

Route::prefix('/')->group(function () {
    Route::get('/', 'CrudController@index');
    Route::get('/create', 'CrudController@create');
    Route::post('/store', 'CrudController@store');

    Route::get('/edit/{id}', 'CrudController@edit');
    Route::post('/update/{id}', 'CrudController@update');

    Route::get('/toggle/{id}', 'CrudController@toggle');

    Route::match(['get', 'post'],'/find', 'CrudController@search');
});