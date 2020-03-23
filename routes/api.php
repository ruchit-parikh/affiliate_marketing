<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace' => 'V1', 
    'prefix' => 'v1', 
    'as' => 'v1.'
], function() {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/send-reset-link', 'AuthController@sendResetPasswordLink');
    Route::post('/reset-password', 'AuthController@resetPassword')->name('reset_password');

    Route::group([
        'middleware' => 'auth'
    ], function() {
        Route::post('/logout', 'AuthController@logout');
    });
});