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
    Route::get('lists/show/{list}', 'ListController@show')->name('lists.show');
    Route::get('lists/edit/{list}', 'ListController@edit')->name('lists.edit');
    Route::get('lists/new', 'ListController@new')->name('lists.new');
    Route::post('lists', 'ListController@index')->name('lists.filter');
    Route::post('lists/new', 'ListController@create')->name('lists.create');
    Route::post('lists/edit/{list}', 'ListController@update')->name('lists.update');

    Route::get('subscriptions', 'SubscriptionController@index')->name('subscriptions.index');
    Route::get('subscriptions/show', 'SubscriptionController@show')->name('subscriptions.show');
    Route::get('subscriptions/new', 'SubscriptionController@new')->name('subscriptions.new');

    Route::get('templates', 'TemplateController@index')->name('templates.index');
    Route::get('templates/show', 'TemplateController@show')->name('templates.show');
    Route::get('templates/new', 'TemplateController@new')->name('templates.new');

    Route::get('settings', 'SettingController@index')->name('settings.index');
});