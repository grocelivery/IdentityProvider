<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/status', 'StatusController@getStatus');
Route::get('/keys/public', 'Auth\KeyController@getPublicKey');

Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/refresh', 'Auth\RefreshTokenController@refresh');

Route::group(['middleware' => 'auth:api'], function (): void {
    Route::get('/me', 'UserController@getAuthenticatedUser');
    Route::post('/logout', 'Auth\LogoutController@logout');
});
