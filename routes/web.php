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

Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('change-language');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('member', 'MemberController');
Route::resource('project', 'ProjectController');
Route::resource('task', 'TaskController');
Route::post('deleteTask', 'TaskController@deleteTask');
Route::post('completeTask', 'TaskController@completeTask');
