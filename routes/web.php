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

/* Route::get('/', function () {
    return view('home');
}); */

Route::get('/', 'HomeController@index')->name('dashboard');

Route::middleware(['auth'])->group(function(){
    Route::prefix('manager')->name('manager.')->namespace('Manager')->group(function(){
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('employees', 'EmployeeController');
    });
});

Route::prefix('manager')->group(function(){
    Auth::routes(['register' => false]);
});
