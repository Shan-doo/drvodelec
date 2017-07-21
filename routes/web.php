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

Route::middleware('locale')->group(function() {

	Route::get('/', 'IndexController@index')->name('home');	

	Route::post('/', 'IndexController@changeLocale');

	Route::post('/message', 'MessageController@store');
});


// admin routes
Route::middleware('auth')->group(function() {

	Route::get('/admin', 'AdminController@index')->name('admin');

	Route::get('/admin/images', 'ImageController@index');

	Route::get('/admin/messages', 'MessageController@index');

	Route::get('/admin/subscribers', 'SubscribersController@index');

	Route::post('/subscribe', 'SubscribersController@store');

	Route::post('/unsubscribe', 'SubscribersController@unsubscriber');

	Route::delete('/admin/subscribers/{subscriber}', 'SubscribersController@destroy');

	Route::post('/admin/categories', 'CategoriesController@store');

	Route::get('/admin/news', 'NewsController@index');

	Route::post('/admin', 'ImageController@store');

	Route::delete('/admin/images', 'ImageController@delete');

	Route::get('/admin/messages/{conversation_id}', 'MessageController@show');

	Route::patch('/admin/messages/{conversation}', 'MessageController@update');

	Route::delete('/admin/messages/{conversation}', 'MessageController@delete');

	Route::post('/admin/response', 'MessageController@respond');

});

// auth routes
Route::namespace('auth')->middleware('locale')->group(function() {

	Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail');

	Route::get('/password/reset{token?}', 'ResetPasswordController@showResetForm')->name('password.reset');

	Route::post('/password/reset', 'ResetPasswordController@reset');

	Route::post('/login', 'LoginController@login');

	Route::get('/logout', 'LoginController@logout');

});