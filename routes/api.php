<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/status', 'StatusController@getStatus');

Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
