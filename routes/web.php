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

Auth::routes();

Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

Route::group(['prefix' => 'help'], function(){
    Route::get('/', ['as' => 'help.index', 'uses' => 'HelpController@index']);
});

Route::group(['prefix' => 'profile'], function(){
    Route::get('/', ['as' => 'profile.index', 'uses' => 'ProfileController@index']);
});

Route::group(['prefix' => 'settings'], function(){
    Route::get('/', ['as' => 'settings.index', 'uses' => 'SettingsController@index']);
});

Route::group(['prefix' => 'websites'], function(){
    Route::get('/', ['as' => 'websites.index', 'uses' => 'WebsitesController@index']);
});
