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

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'HomeController@index');

    Route::get('campaigns', 'CampaignController@index')->name('campaigns.index');
    Route::get('campaigns/show', 'CampaignController@index')->name('campaigns.show');
    Route::get('campaigns/new', 'CampaignController@new')->name('campaigns.new');

    Route::get('lists', 'ListController@index')->name('lists.index');
    Route::get('lists/show', 'ListController@show')->name('lists.show');
    Route::get('lists/new', 'ListController@new')->name('lists.new');

    Route::get('subscriptions', 'SubscriptionController@index')->name('subscriptions.index');
    Route::get('subscriptions/show', 'SubscriptionController@show')->name('subscriptions.show');
    Route::get('subscriptions/new', 'SubscriptionController@new')->name('subscriptions.new');

    Route::get('settings', 'SettingController@index')->name('settings.index');
    Route::post('settings/driver/update', 'SettingController@diver')->name('settings.driver');
});