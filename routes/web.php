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

Route::GET('/home', 'HomeController@index')->name('home');

// MaterialモデルCRUD
Route::resource('/material','MaterialController')->middleware('auth');
// | POST      | material                 | material.store   | App\Http\Controllers\MaterialController@store                          | web          |
// | GET|HEAD  | material                 | material.index   | App\Http\Controllers\MaterialController@index                          | web          |
// | GET|HEAD  | material/create          | material.create  | App\Http\Controllers\MaterialController@create                         | web          |
// | PUT|PATCH | material/{material}      | material.update  | App\Http\Controllers\MaterialController@update                         | web          |
// | GET|HEAD  | material/{material}      | material.show    | App\Http\Controllers\MaterialController@show                           | web          |
// | DELETE    | material/{material}      | material.destroy | App\Http\Controllers\MaterialController@destroy                        | web          |
// | GET|HEAD  | material/{material}/edit | material.edit    | App\Http\Controllers\MaterialController@edit                           | web          |
Route::GET('/material/{material}/show','MaterialController@show_all')->name('material.show_all');

// Groupモデル新規作成画面&作成
Route::GET('/group/create','MaterialController@group_create')->name('group_create');
Route::POST('/group/store','MaterialController@group_store')->name('group_store');

// Groupモデル編集画面&上書き
Route::GET('/group/{group}/edit','MaterialController@group_edit')->name('group_edit');
Route::PUT('/group/{group}','MaterialController@group_update')->name('group_update');

// Group削除
Route::DELETE('/group/{group}','MaterialController@group_destroy')->name('group_destroy');

// Play画面
Route::GET('/group/{group}','GroupController@show')->name('group.show');
Route::GET('/group','GroupController@index')->name('group.index');

Route::GET('/php_info','GroupController@php_info')->name('group.php_info');