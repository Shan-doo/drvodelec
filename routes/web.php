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
Route::middleware(['auth', 'admin'])->group(function() {

	Route::get('/admin', 'AdminController@index')->name('admin');

	Route::get('/admin/users', 'UsersController@index');

	Route::get('/admin/users/stats', 'UsersController@showStats');

	Route::get('/admin/users/{user}', 'UsersController@show');

	Route::patch('/admin/users/{user}', 'UsersController@update');

	Route::post('/admin/users/avatars', 'ImageController@storeTempAvatar');

	Route::delete('/admin/users/avatars/', 'ImageController@deleteTempAvatar');


	Route::get('/admin/images', 'ImageController@index');

	Route::get('/admin/images/create', 'ImageController@create');

	Route::delete('/admin/images', 'ImageController@delete');

	Route::post('/admin/images/create', 'ImageController@store');

	Route::post('/admin/api/cropped-img', 'ImageController@decodeAndStoreImg');


	Route::get('/admin/messages', 'MessageController@index');

	Route::get('/admin/messages/create', 'MessageController@create');


	Route::get('/admin/subscribers', 'SubscribersController@index');

	Route::get('/admin/subscribers/stats', 'SubscribersController@showStats');

	Route::post('/subscribe', 'SubscribersController@store');

	Route::post('/unsubscribe', 'SubscribersController@unsubscriber');

	Route::delete('/admin/subscribers/{subscriber}', 'SubscribersController@destroy');


	Route::post('/admin/categories', 'CategoriesController@store');
	

	Route::get('/admin/news', 'NewsController@index')->name('news');

	Route::get('/admin/news/create', 'NewsController@create');

	Route::get('/admin/news/{news}', 'NewsController@show')->name('news-show');
	
	Route::post('/admin/news', 'NewsController@store');

	Route::delete('/admin/news/{news}', 'NewsController@delete');

	Route::delete('/admin/news/images/{imageHash}', 'NewsController@deleteEditorImage');

	Route::get('/admin/news/{news}/edit', 'NewsController@edit');

	Route::put('/admin/news/{news}', 'NewsController@update');

	

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

	Route::post('/logout', 'LoginController@logout');

	Route::post('/register', 'RegisterController@register')->name('register');

});