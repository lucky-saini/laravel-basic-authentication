<?php

Route::group(['middleware' => ['web']], function () {
	  
	Route::group(['namespace' => 'App\Http\Controllers'], function() {

		// Authentication Routes...
		Route::get('login', 'Auth\AuthController@showLoginForm');
		Route::post('login', 'Auth\AuthController@login');
		Route::get('logout', 'Auth\AuthController@logout');

		// Registration Routes...
		Route::get('register', 'Auth\AuthController@showRegistrationForm');
		Route::post('register', 'Auth\AuthController@register');

		// Password Reset Routes...
		Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
		Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
		Route::post('password/reset', 'Auth\PasswordController@reset');
	});

	// Authentication Routes...
	Route::group(['prefix' => config('admin-auth.prefix'), 'namespace' => 'App\Http\Controllers'], 
		function() {
		
		Route::get('login', ['as' => 'admin.login', 'uses' => 'Auth\AuthAdminController@showLoginForm']);
		Route::post('login', ['as' => 'admin.post.login', 'uses' => 'Auth\AuthAdminController@login']);
		Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Auth\AuthAdminController@logout']);

		// Registration Routes...
		Route::get('register', ['as' => 'admin.register', 'uses' => 'Auth\AuthAdminController@showRegistrationForm']);
		Route::post('register', ['as' => 'admin.post.register', 'uses' => 'Auth\AuthAdminController@register']);

		// Password Reset Routes...
		Route::get('password/reset/{token?}', ['as' => 'admin.password.reset', 'uses' => 'Auth\PasswordAdminController@showResetForm']);
		Route::post('password/email', ['as' => 'admin.password.post.email', 'uses' => 'Auth\PasswordAdminController@sendResetLinkEmail']);
		Route::post('password/reset', ['as' => 'admin.password.post.reset', 'uses' => 'Auth\PasswordAdminController@reset']);
	});
});