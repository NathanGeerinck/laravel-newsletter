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
    Route::get('campaigns/show/{campaign}', 'CampaignController@show')->name('campaigns.show');
    Route::get('campaigns/edit/{campaign}', 'CampaignController@edit')->name('campaigns.edit');
    Route::get('campaigns/clone/{campaign}', 'CampaignController@new')->name('campaigns.clone');
    Route::get('campaigns/new', 'CampaignController@new')->name('campaigns.new');
    Route::post('campaigns', 'CampaignController@index')->name('campaigns.filter');
    Route::post('campaigns/new', 'CampaignController@create')->name('campaigns.create');
    Route::post('campaigns/edit/{list}', 'CampaignController@update')->name('campaigns.update');
    Route::post('campaigns/send/{list}', 'CampaignController@send')->name('campaigns.send');

    Route::get('lists', 'MailingListController@index')->name('lists.index');
    Route::get('lists/show/{list}', 'MailingListController@show')->name('lists.show');
    Route::get('lists/edit/{list}', 'MailingListController@edit')->name('lists.edit');
    Route::get('lists/clone/{list}', 'MailingListController@new')->name('lists.clone');
    Route::get('lists/new', 'MailingListController@new')->name('lists.new');
    Route::post('lists', 'MailingListController@index')->name('lists.filter');
    Route::post('lists/new', 'MailingListController@create')->name('lists.create');
    Route::post('lists/edit/{list}', 'MailingListController@update')->name('lists.update');

    Route::get('subscriptions', 'SubscriptionController@index')->name('subscriptions.index');
    Route::get('subscriptions/show/{subscription}', 'SubscriptionController@show')->name('subscriptions.show');
    Route::get('subscriptions/edit/{subscription}', 'SubscriptionController@edit')->name('subscriptions.edit');
    Route::get('subscriptions/clone/{subscription}', 'SubscriptionController@new')->name('subscriptions.clone');
    Route::get('subscriptions/new', 'SubscriptionController@new')->name('subscriptions.new');
    Route::post('subscriptions', 'SubscriptionController@index')->name('subscriptions.filter');
    Route::post('subscriptions/new', 'SubscriptionController@create')->name('subscriptions.create');
    Route::post('subscriptions/edit/{subscription}', 'SubscriptionController@update')->name('subscriptions.update');

    Route::get('templates', 'TemplateController@index')->name('templates.index');
    Route::get('templates/show/{template}', 'TemplateController@show')->name('templates.show');
    Route::get('templates/edit/{template}', 'TemplateController@edit')->name('templates.edit');
    Route::get('templates/clone/{template}', 'TemplateController@new')->name('templates.clone');
    Route::get('templates/new', 'TemplateController@new')->name('templates.new');
    Route::post('templates', 'TemplateController@index')->name('templates.filter');
    Route::post('templates/new', 'TemplateController@create')->name('templates.create');
    Route::post('templates/edit/{subscription}', 'TemplateController@update')->name('templates.update');

    Route::get('settings', 'Settings\SettingController@index')->name('settings.index');
    Route::get('settings/users', 'Settings\UserController@index')->name('settings.users');
});

Route::get('templates/preview/{template}', 'TemplateController@preview')->name('templates.preview');