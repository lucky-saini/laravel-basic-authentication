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
	Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers'], 
		function() {
		
		Route::get('login', 'Auth\AuthAdminController@showLoginForm');
		Route::post('login', 'Auth\AuthAdminController@login');
		Route::get('logout', 'Auth\AuthAdminController@logout');

		// Registration Routes...
		Route::get('register', 'Auth\AuthAdminController@showRegistrationForm');
		Route::post('register', 'Auth\AuthAdminController@register');

		// Password Reset Routes...
		Route::get('password/reset/{token?}', 'Auth\PasswordAdminController@showResetForm');
		Route::post('password/email', 'Auth\PasswordAdminController@sendResetLinkEmail');
		Route::post('password/reset', 'Auth\PasswordAdminController@reset');
	});
});