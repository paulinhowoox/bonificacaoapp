<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('dashboard');

Route::middleware(['auth'])->group(function(){
    Route::prefix('manager')->name('manager.')->namespace('Manager')->group(function(){
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::resource('permissions', 'PermissionController')->except('show');
        Route::resource('roles', 'RoleController')->except('show');
        Route::resource('employees', 'EmployeeController');
        Route::resource('users', 'UserController')->except('show');
        Route::resource('transactions', 'TransactionController');
    });
});

Route::prefix('manager')->group(function(){
    Auth::routes(['register' => false]);
});
