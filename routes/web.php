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

Route::get('templates/preview/{template}', 'TemplateController@preview')->name('templates.preview');

Route::get('unsubscribe/{email}/{unsubscribe}', 'SubscriptionController@preUnsubscribe')->name('subscriptions.preunsubscribe');
Route::delete('unsubscribe/{subscription}', 'SubscriptionController@unsubscribe')->name('subscriptions.unsubscribe');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('index');

    Route::group(['prefix' => 'campaigns', 'as' => 'campaigns.'], function () {
        Route::get('/', 'CampaignController@index')->name('index');
        Route::get('show/{campaign}', 'CampaignController@show')->name('show');
        Route::get('edit/{campaign}', 'CampaignController@edit')->name('edit');
        Route::get('clone/{campaign}', 'CampaignController@new')->name('clone');
        Route::get('send/{campaign}', 'CampaignController@preSend')->name('presend');
        Route::get('new', 'CampaignController@new')->name('new');
        Route::get('export/{campaign}', 'CampaignController@export')->name('export');
        Route::post('/', 'CampaignController@index')->name('filter');
        Route::post('new', 'CampaignController@create')->name('create');
        Route::post('edit/{campaign}', 'CampaignController@update')->name('update');
        Route::post('send/{campaign}', 'CampaignController@send')->name('send');
        Route::delete('delete/{campaign}', 'CampaignController@delete')->name('delete');
    });

    Route::group(['prefix' => 'lists', 'as' => 'lists.'], function () {
        Route::get('/', 'MailingListController@index')->name('index');
        Route::get('show/{list}', 'MailingListController@show')->name('show');
        Route::get('edit/{list}', 'MailingListController@edit')->name('edit');
        Route::get('clone/{list}', 'MailingListController@new')->name('clone');
        Route::get('new', 'MailingListController@new')->name('new');
        Route::get('list/export/{list}', 'MailingListController@export')->name('export');
        Route::get('list/import/{list}', 'MailingListController@preImport')->name('preimport');
        Route::post('/', 'MailingListController@index')->name('filter');
        Route::post('new', 'MailingListController@create')->name('create');
        Route::post('edit/{list}', 'MailingListController@update')->name('update');
        Route::post('import/{list}', 'MailingListController@import')->name('import');
        Route::delete('delete/{list}', 'MailingListController@delete')->name('delete');
    });

    Route::group(['prefix' => 'subscriptions', 'as' => 'subscriptions.'], function () {
        Route::get('/', 'SubscriptionController@index')->name('index');
        Route::get('show/{subscription}', 'SubscriptionController@show')->name('show');
        Route::get('edit/{subscription}', 'SubscriptionController@edit')->name('edit');
        Route::get('clone/{subscription}', 'SubscriptionController@new')->name('clone');
        Route::get('new', 'SubscriptionController@new')->name('new');
        Route::get('export/{method}', 'SubscriptionController@export')->name('export');
        Route::post('/', 'SubscriptionController@index')->name('filter');
        Route::post('new', 'SubscriptionController@create')->name('create');
        Route::post('edit/{subscription}', 'SubscriptionController@update')->name('update');
        Route::delete('delete/{subscription}', 'SubscriptionController@delete')->name('delete');
    });
    
    Route::group(['prefix' => 'templates', 'as' => 'templates.'], function () {
        Route::get('/', 'TemplateController@index')->name('index');
        Route::get('show/{template}', 'TemplateController@show')->name('show');
        Route::get('edit/{template}', 'TemplateController@edit')->name('edit');
        Route::get('clone/{template}', 'TemplateController@new')->name('clone');
        Route::get('new', 'TemplateController@new')->name('new');
        Route::post('/', 'TemplateController@index')->name('filter');
        Route::post('new', 'TemplateController@create')->name('create');
        Route::post('edit/{template}', 'TemplateController@update')->name('update');
        Route::delete('delete/{template}', 'TemplateController@delete')->name('delete');
    });

    Route::group(['prefix' => 'settings', 'as' => 'settings.', 'namespace' => 'Settings'], function () {
        Route::get('/', 'ApplicationController@index')->name('application');
        Route::get('mail', 'MailController@index')->name('mail');
        Route::get('users', 'UserController@index')->name('users');
        Route::post('/', 'ApplicationController@update')->name('application.update');
        Route::post('mail', 'MailController@update')->name('mail.update');
    });

    Route::group(['prefix' => 'account', 'as' => 'account.', 'namespace' => 'Account'], function () {
        Route::get('/', 'GeneralController@index')->name('general');
        Route::get('password', 'PasswordController@index')->name('password');
        Route::get('2fa', 'TwoFactorController@index')->name('2fa');
        Route::get('2fa/disable', 'TwoFactorController@disable')->name('2fa.disable');
        Route::get('2fa/enable', 'TwoFactorController@enable')->name('2fa.enable');
        Route::post('/', 'GeneralController@update')->name('general.update');
        Route::post('password', 'PasswordController@update')->name('password.update');
        Route::post('2fa/disable', 'TwoFactorController@disable')->name('2fa.disable');
        Route::post('2fa/enable', 'TwoFactorController@enable')->name('2fa.enable');
        Route::post('2fa/verify', 'TwoFactorController@verify')->name('2fa.verify');
    });
});