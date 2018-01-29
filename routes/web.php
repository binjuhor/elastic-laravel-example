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


/**
 * Search
 */
Route::group(['prefix' => 'search' ], function (){
    Route::get('/', 'SearchController@index');
    Route::get('/itemindex', 'ItemsController@getItemList');
    Route::post('/items','SearchController@searchItems');
    Route::get('/advance','SearchController@searchAdvance');
    Route::get('/items','SearchController@index');
    //Route for ajax
    Route::get('index/{id}', 'SearchController@indexElastic');
});

