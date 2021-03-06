<?php

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
    Route::post('/login', 'AuthController@login')->name('login');
    Route::post('/register', 'AuthController@register')->name('register');
    Route::post('/send-reset-link', 'AuthController@sendResetPasswordLink')->name('send_password_link');
    Route::post('/reset-password', 'AuthController@resetPassword')->name('reset_password');

    Route::group([
        'middleware' => ['jwt.auth']
    ], function() {
        Route::group([
            'namespace' => 'Admin',
            'middleware' => ['role:admin', 'active'], 
            'prefix' => 'admin', 
            'as' => 'admin.'
        ], function() {
            Route::post('/dashboard', 'DashboardController@index')->name('dashboard.index');
            Route::apiResource('/packages', 'PackageController')->except('show');
            Route::apiResource('/commissions', 'CommissionController')->except('show');
        });

        Route::group([
            'namespace' => 'Customer',
            'middleware' => ['role:customer', 'active'], 
            'prefix' => 'customer', 
            'as' => 'customer.'
        ], function() {
            Route::get('/packages', 'PackageController@index')->name('packages.index');
        });
        Route::post('/logout', 'AuthController@logout')->name('logout');
    });
});