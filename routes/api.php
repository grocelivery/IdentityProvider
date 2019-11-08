<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/status', 'StatusController@getStatus');

Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/activate/{token}', 'Auth\AccountActivationController@activate');

Route::get('/me', 'UserController@getAuthenticatedUser')->middleware('auth:api');