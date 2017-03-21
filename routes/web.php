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


Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

Route::get('templates/preview/{template}', 'TemplateController@preview')->name('templates.preview');

Route::get('unsubscribe/{email}/{unsubscribe}', 'SubscriptionController@preUnsubscribe')->name('subscriptions.preunsubscribe');
Route::delete('unsubscribe/{subscription}', 'SubscriptionController@unsubscribe')->name('subscriptions.unsubscribe');

Route::group(['middleware' => ['auth']], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('campaigns', 'CampaignController@index')->name('campaigns.index');
    Route::get('campaigns/show/{campaign}', 'CampaignController@show')->name('campaigns.show');
    Route::get('campaigns/edit/{campaign}', 'CampaignController@edit')->name('campaigns.edit');
    Route::get('campaigns/clone/{campaign}', 'CampaignController@new')->name('campaigns.clone');
    Route::get('campaigns/send/{campaign}', 'CampaignController@preSend')->name('campaigns.presend');
    Route::get('campaigns/new', 'CampaignController@new')->name('campaigns.new');
    Route::get('campaigns/export/{campaign}', 'CampaignController@export')->name('campaigns.export');
    Route::post('campaigns', 'CampaignController@index')->name('campaigns.filter');
    Route::post('campaigns/new', 'CampaignController@create')->name('campaigns.create');
    Route::post('campaigns/edit/{campaign}', 'CampaignController@update')->name('campaigns.update');
    Route::post('campaigns/send/{campaign}', 'CampaignController@send')->name('campaigns.send');
    Route::delete('campaigns/delete/{campaign}', 'CampaignController@delete')->name('campaigns.delete');

    Route::get('lists', 'MailingListController@index')->name('lists.index');
    Route::get('lists/show/{list}', 'MailingListController@show')->name('lists.show');
    Route::get('lists/edit/{list}', 'MailingListController@edit')->name('lists.edit');
    Route::get('lists/clone/{list}', 'MailingListController@new')->name('lists.clone');
    Route::get('lists/new', 'MailingListController@new')->name('lists.new');
    Route::get('list/export/{list}', 'MailingListController@export')->name('lists.export');
    Route::get('list/import/{list}', 'MailingListController@preImport')->name('lists.preimport');
    Route::post('lists', 'MailingListController@index')->name('lists.filter');
    Route::post('lists/new', 'MailingListController@create')->name('lists.create');
    Route::post('lists/edit/{list}', 'MailingListController@update')->name('lists.update');
    Route::post('lists/import/{list}', 'MailingListController@import')->name('lists.import');
    Route::delete('lists/delete/{list}', 'MailingListController@delete')->name('lists.delete');

    Route::get('subscriptions', 'SubscriptionController@index')->name('subscriptions.index');
    Route::get('subscriptions/show/{subscription}', 'SubscriptionController@show')->name('subscriptions.show');
    Route::get('subscriptions/edit/{subscription}', 'SubscriptionController@edit')->name('subscriptions.edit');
    Route::get('subscriptions/clone/{subscription}', 'SubscriptionController@new')->name('subscriptions.clone');
    Route::get('subscriptions/new', 'SubscriptionController@new')->name('subscriptions.new');
    Route::get('subscriptions/export/{method}', 'SubscriptionController@export')->name('subscriptions.export');
    Route::post('subscriptions', 'SubscriptionController@index')->name('subscriptions.filter');
    Route::post('subscriptions/new', 'SubscriptionController@create')->name('subscriptions.create');
    Route::post('subscriptions/edit/{subscription}', 'SubscriptionController@update')->name('subscriptions.update');
    Route::delete('subscriptions/delete/{subscription}', 'SubscriptionController@delete')->name('subscriptions.delete');

    Route::get('templates', 'TemplateController@index')->name('templates.index');
    Route::get('templates/show/{template}', 'TemplateController@show')->name('templates.show');
    Route::get('templates/edit/{template}', 'TemplateController@edit')->name('templates.edit');
    Route::get('templates/clone/{template}', 'TemplateController@new')->name('templates.clone');
    Route::get('templates/new', 'TemplateController@new')->name('templates.new');
    Route::post('templates', 'TemplateController@index')->name('templates.filter');
    Route::post('templates/new', 'TemplateController@create')->name('templates.create');
    Route::post('templates/edit/{template}', 'TemplateController@update')->name('templates.update');
    Route::delete('templates/delete/{template}', 'TemplateController@delete')->name('templates.delete');

    Route::get('settings', 'Settings\ApplicationController@index')->name('settings.application');
    Route::get('settings/mail', 'Settings\MailController@index')->name('settings.mail');
    Route::get('settings/users', 'Settings\UserController@index')->name('settings.users');
    Route::post('settings', 'Settings\ApplicationController@update')->name('settings.application.update');
    Route::post('settings/mail', 'Settings\MailController@update')->name('settings.mail.update');
});