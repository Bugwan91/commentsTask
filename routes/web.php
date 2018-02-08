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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Auth'], function() {
    Route::group(['prefix' => 'login', 'as' => 'login'], function () {
        Route::get('/', 'LoginController@showLoginForm');
        Route::post('/', 'LoginController@login');
    });
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::group(['prefix' => 'password', 'as' => 'password'], function () {
        Route::post('/email', 'ForgotPasswordController@sendResetLinkEmail')->name('.email');
        Route::get('/reset', 'ForgotPasswordController@showLinkRequestForm')->name('.request');
        Route::post('/reset', 'ForgotPasswordController@reset');
        Route::get('/reset/{token}', 'ForgotPasswordController@showResetForm')->name('.reset');
    });
    Route::group(['prefix' => 'register', 'as' => 'register'], function () {
        Route::get('/', 'RegisterController@showRegistrationForm');
        Route::post('/', 'RegisterController@register');
    });
});

Route::get('/cabinet', 'AccountController@showCabinet')->name('cabinet');

Route::group(['prefix' => 'post', 'as' => 'post'], function() {
    Route::group(['prefix' => '{id}'], function() {
        Route::get('/', 'PostController@showPost')->name('.show');
        Route::post('/comments', 'PostController@getComments')->name('.comments');
    });
});

Route::group(['prefix' => '/comments', 'as' => 'comments'], function() {
    Route::post('/add', 'CommentsController@add')->name('.add');
    Route::post('/edit', 'CommentsController@edit')->name('.edit');
    Route::post('/vote', 'CommentsController@vote')->name('.vote');
    Route::post('/remove', 'CommentsController@remove')->name('.remove');
});