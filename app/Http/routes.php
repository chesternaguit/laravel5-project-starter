<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('Defaults.Views.layouts.pages.welcome');
});

Route::get('about', [
    'as' => 'about', 
    'uses' => 'Defaults\Controllers\PagesController@showAbout'
]);

Route::get('contact', [
    'as' => 'contact', 
    'uses' => 'Defaults\Controllers\PagesController@showContact'
]);

Route::get('help', [
    'as' => 'help', 
    'uses' => 'Defaults\Controllers\PagesController@showHelp'
]);

Route::group(['prefix' => 'administration'], function() {
    Route::resource('users/groups', 'Administration\Controllers\GroupController');
    Route::resource('users', 'Administration\Controllers\UserController');
    Route::get('users/{id}/delete', 'Administration\Controllers\UserController@destroy');
    Route::resource('permissions', 'Administration\Controllers\PermissionController');
});

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
|
| 
|
*/
Route::group(['prefix' => 'api'], function() {
    Route::get('user', 'api\Eloquent\ApiController@getAllUsers');
});

