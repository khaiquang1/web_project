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

Route::get('/', function () {
    return view('welcome');
});


Route::get('admincp/login','App\Http\Controllers\Admin\Auth\LoginController@getLogin')->name('admin.getLogin');
Route::post('admincp/login','App\Http\Controllers\Admin\Auth\LoginController@postLogin')->name('admin.postLogin');
Route::get('admincp/logout','App\Http\Controllers\Admin\Auth\LoginController@getLogout')->name('admin.getLogout');
Route::group(['middleware' => 'checkAdminLogin', 'prefix' => 'admincp', 'namespace' => 'Admin'], function() {
	Route::get('/','App\Http\Controllers\Admin\Dashboard\DashboardController@getDashboard')->name('admin.getDashboard');
});

