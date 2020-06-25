<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', 'SignInController@index')->name('/');
    Route::post('userauthenticate', 'SignInController@userAuthenticate')->name('userauthenticate');

});
Route::get('signout', 'SignInController@signOut')->name('signout');
Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});
