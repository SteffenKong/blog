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


Route::group(['namespace'=>'admin','prefix'=>'admin'],function() {

    Route::get('getPublicKey','LoginController@getPublicKey');
    Route::get('login','LoginController@login');
    Route::post('sign','LoginController@sign');
    Route::get('logout','IndexController@logout')->name('logout');
    Route::group(['middleware'=>['CheckLogin']],function() {
        Route::get('index','IndexController@index')->name('index');

        Route::group(['prefix'=>'admin'],function() {
            Route::get('index','AdminController@index')->name('/admin/index');
            Route::get('add','AdminController@add')->name('/admin/add');
            Route::post('doAdd','AdminController@doAdd');
            Route::post('changeStatus/{id}','AdminController@changeStatus');
            Route::get('edit/{id}','AdminController@edit');
            Route::put('doEdit','AdminController@doEdit');
            Route::delete('delete/{id}','AdminController@delete');
        });
    });
});
