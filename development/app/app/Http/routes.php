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

Route::get('test', 'TestController@getTest');

// Auth routes
Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('registration', 'AuthController@getRegistration');
Route::post('registration', 'AuthController@postRegistration');

// Workflow routes
Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'workflow'], function() {

        Route::get('/', 'WorkflowController@getWorkflow');
        Route::post('search', 'TestController@postSearch');

        Route::group(['prefix' => 'item'], function() {

            Route::get('view/{id}', 'ItemController@getView');
            Route::post('edit/{id}', 'ItemController@postEdit');
            Route::post('delete/{id}', 'ItemController@postDelete');
        });
    });
});