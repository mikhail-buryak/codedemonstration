<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('images/covers/{file}','ImageController@getImageCover');

    Route::get('/home', 'HomeController@index');

    Route::group(['prefix' => 'workflow'], function() {

        Route::get('/', 'WorkflowController@index');

        Route::group(['prefix' => 'items'], function() {
            Route::get('all', 'ItemController@getAll');
            Route::get('view/{id}', 'ItemController@getView');
            Route::get('edit/{id}', 'ItemController@getEdit');
            Route::post('store/{id?}', 'ItemController@postStore');
            Route::post('delete/{id}', 'ItemController@postDelete');
        });
    });
});