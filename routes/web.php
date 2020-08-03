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

// Route::resource('group','GroupController');
// |        | POST      | group                  | group.store      | App\Http\Controllers\GroupController@store                             | web          |
// |        | GET|HEAD  | group                  | group.index      | App\Http\Controllers\GroupController@index                             | web          |
// |        | GET|HEAD  | group/create           | group.create     | App\Http\Controllers\GroupController@create                            | web          |
// |        | PUT|PATCH | group/{group}          | group.update     | App\Http\Controllers\GroupController@update                            | web          |
// |        | GET|HEAD  | group/{group}          | group.show       | App\Http\Controllers\GroupController@show                              | web          |
// |        | DELETE    | group/{group}          | group.destroy    | App\Http\Controllers\GroupController@destroy                           | web          |
// |        | GET|HEAD  | group/{group}/edit     | group.edit       | App\Http\Controllers\GroupController@edit                              | web          |
Route::GET('/material/{material}/show','MaterialController@show_all')->name('material_show_all');
Route::resource('/material','MaterialController');
//          | POST      | material                 | material.store   | App\Http\Controllers\MaterialController@store                          | web          |
//          | GET|HEAD  | material                 | material.index   | App\Http\Controllers\MaterialController@index                          | web          |
// |        | GET|HEAD  | material/create          | material.create  | App\Http\Controllers\MaterialController@create                         | web          |
// |        | PUT|PATCH | material/{material}      | material.update  | App\Http\Controllers\MaterialController@update                         | web          |
// |        | GET|HEAD  | material/{material}      | material.show    | App\Http\Controllers\MaterialController@show                           | web          |
// |        | DELETE    | material/{material}      | material.destroy | App\Http\Controllers\MaterialController@destroy                        | web          |
// |        | GET|HEAD  | material/{material}/edit | material.edit    | App\Http\Controllers\MaterialController@edit                           | web          |
// |        | POST      | password/email           | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
// |        | POST      | password/reset           | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
// |        | GET|HEAD  | password/reset           | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
// |        | GET|HEAD  | password/reset/{token}   | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
// |        | POST      | register                 |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
// |        | GET|HEAD  | register                 | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
// +--------+-----------+--------------------------+------------------+------------------------------------------------------------------------+--------------+
Route::GET('/group/create','MaterialController@group_create')->name('group_create');
Route::POST('/group/store','MaterialController@group_store')->name('group_store');
Route::GET('/group/{group}/edit','MaterialController@group_edit')->name('group_edit');
Route::PUT('/group/{group}','MaterialController@group_update')->name('group_update');
Route::GET('/group/{group}','MaterialController@group_show')->name('group_show');
Route::DELETE('/group/{group}','MaterialController@group_destroy')->name('group_destroy');

