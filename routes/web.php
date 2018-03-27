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

Route::group(['prefix' => 'api'], function(){
    Route::group(['prefix' => '/metrics'], function(){
        Route::get('/cpu', ['as' => 'api.metrics.cpu', 'uses' => 'Api\MetricsController@getCpu']);
        Route::get('/ram', ['as' => 'api.metrics.ram', 'uses' => 'Api\MetricsController@getRam']);
        Route::get('/disk', ['as' => 'api.metrics.disk', 'uses' => 'Api\MetricsController@getDisk']);
        Route::get('/network-rx', ['as' => 'api.metrics.network-rx', 'uses' => 'Api\MetricsController@getNetworkRx']);
        Route::get('/network-tx', ['as' => 'api.metrics.network-tx', 'uses' => 'Api\MetricsController@getNetworkTx']);
        Route::get('/mem-and-disk', ['as' => 'api.metrics.mem-and-disk', 'uses' => 'Api\MetricsController@getMemAndDisk']);
    });
    Route::group(['prefix' => 'websites'], function(){
        Route::post('/add', ['as' => 'api.websites.add', 'uses' => 'Api\WebsitesController@addVhost']);
        Route::get('/status', ['as' => 'api.websites.status', 'uses' => 'Api\WebsitesController@getStatus']);
        Route::get('/vhosts', ['as' => 'api.websites.vhosts', 'uses' => 'Api\WebsitesController@getVhosts']);
        Route::group(['prefix' => '/vhost'], function(){
            Route::get('/{key?}', ['as' => 'api.websites.vhost', 'uses' => 'Api\WebsitesController@getVhost']);
            Route::get('/{key?}/form', ['as' => 'api.websites.vhost.form', 'uses' => 'Api\WebsitesController@getVhostForm']);
            Route::post('/{key?}/form', ['as' => 'api.websites.vhost.form', 'uses' => 'Api\WebsitesController@postVhostForm']);
        });
    });
});

Route::group(['prefix' => 'charts'], function(){
    Route::get('/circle', ['as' => 'charts.circle', 'uses' => 'ChartsController@circle']);
});

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
    Route::get('/vhost/add', ['as' => 'websites.vhost.add', 'uses' => 'WebsitesController@vhostAdd']);
    Route::get('/vhost/{key?}', ['as' => 'websites.vhost', 'uses' => 'WebsitesController@vhost']);
    Route::get('/vhost/{key?}/edit', ['as' => 'websites.vhost.edit', 'uses' => 'WebsitesController@vhostEdit']);
    Route::get('/vhost/{key?}/enable', ['as' => 'websites.vhost.enable', 'uses' => 'WebsitesController@vhostEnable']);
    Route::get('/vhost/{key?}/disable', ['as' => 'websites.vhost.disable', 'uses' => 'WebsitesController@vhostDisable']);
    Route::get('/vhost/{key?}/delete', ['as' => 'websites.vhost.delete', 'uses' => 'WebsitesController@vhostDelete']);
});
