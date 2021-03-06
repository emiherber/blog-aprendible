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
// Rutas web
Route::get('/', 'PagesController@home')->name('pages.home');
Route::get('about', 'PagesController@about')->name('pages.about');
Route::get('archive', 'PagesController@archive')->name('pages.archive');
Route::get('contact', 'PagesController@contact')->name('pages.contact');
Route::get('blog/{post}', 'PostsController@show')->name('posts.show');
Route::get('category/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');

// Rutas de administración.
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
  Route::get('/', 'AdminController@index')->name('admin');
  
  Route::resource('posts', 'PostsController', ['except' => 'show', 'as' => 'admin']);
  
  Route::resource('users', 'UsersController', ['as' => 'admin']);

  Route::resource('roles', 'RolesController', ['except' => 'show', 'as' => 'admin']);
  
  Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'edit', 'update'], 'as' => 'admin']);

  Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.strore');
  
  Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');

  Route::middleware('role:Admin')
        ->put('users/{user}/roles', 'UsersRolesController@update')
        ->name('admin.users.roles.update');

  Route::middleware('role:Admin')
        ->put('users/{user}/permissions', 'UsersPermissionsController@update')
        ->name('admin.users.permissions.update');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Registration Routes...
//Route::get('/RegisterController', 'Auth\RegisterController@index')->name('register.index');
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register.create');
//Route::post('register', 'Auth\RegisterController@register')->name('register.store');
//Route::get('register/{id}', 'Auth\RegisterController@edit')->name('register.edit');
//Route::put('register/{id}', 'Auth\RegisterController@update')->name('register.update');
//Route::delete('destroy/{id}', 'Auth\RegisterController@destroy')->name('register.destroy');