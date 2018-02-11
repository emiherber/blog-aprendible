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
// Rutas de administración.
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('posts', 'PostsController@index')->name('admin.posts.index');
    Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
    
});

Route::get('/', 'PagesController@home');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//// Registration Routes...
//Route::get('/RegisterController', 'Auth\RegisterController@index')->name('register.index');
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register.create');
//Route::post('register', 'Auth\RegisterController@register')->name('register.store');
//Route::get('register/{id}', 'Auth\RegisterController@edit')->name('register.edit');
//Route::put('register/{id}', 'Auth\RegisterController@update')->name('register.update');
//Route::delete('destroy/{id}', 'Auth\RegisterController@destroy')->name('register.destroy');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
