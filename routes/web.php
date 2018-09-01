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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Admin routes
 */
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/city', 'CityController@index')->name('city.index');
Route::get('/admin/city/create', ['middleware' => 'auth'], 'CityController@create')->name('city.create');

Route::post('skill/search', 'JobController@search')->name('skill.search');

Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('cities', 'CityController');
