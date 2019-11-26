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

Route::group(['namespace'=>'Admin','prefix'=>'admin'],function() {
    Route::get('getPublicKey','LoginController@getPublicKey');

    //登录页
    Route::group(['middleware' => ['IsLogin']],function() {
        Route::get('login','LoginController@login');
        Route::post('sign','LoginController@sign');
    });

    Route::get('logout','IndexController@logout')->name('logout');
    Route::group(['middleware'=>['CheckLogin']],function() {
        Route::get('index','IndexController@index')->name('index');

        //管理员模块
        Route::group(['prefix'=>'admin'],function() {
            Route::get('index','AdminController@index')->name('/admin/index');
            Route::get('add','AdminController@add')->name('/admin/add');
            Route::post('doAdd','AdminController@doAdd');
            Route::post('changeStatus/{id}','AdminController@changeStatus');
            Route::get('edit/{id}','AdminController@edit');
            Route::put('doEdit','AdminController@doEdit');
            Route::delete('delete/{id}','AdminController@delete');
        });


        //标签管理
        Route::group(['prefix'=>'tags'],function() {
            Route::get('index','TagsController@index')->name('/tags/index');
            Route::get('add','TagsController@add')->name('/tags/add');
            Route::post('doAdd','TagsController@doAdd');
            Route::post('changeStatus/{id}','TagsController@changeStatus');
            Route::get('edit/{id}','TagsController@edit');
            Route::put('doEdit','TagsController@doEdit');
            Route::delete('delete/{id}','TagsController@delete');
            Route::get('getDescriptionById/{id}','TagsController@getDescriptionById');
        });


        //分类管理
        Route::group(['prefix'=>'category'],function() {
            Route::get('index','CategoryController@index')->name('/category/index');
            Route::get('add','CategoryController@add')->name('/category/add');
            Route::post('doAdd','CategoryController@doAdd');
            Route::post('changeStatus/{id}','CategoryController@changeStatus');
            Route::get('edit/{id}','CategoryController@edit');
            Route::put('doEdit','CategoryController@doEdit');
            Route::delete('delete/{id}','CategoryController@delete');
        });


        //友情链接管理
        Route::group(['prefix'=>'link'],function() {
            Route::get('index','LinkController@index')->name('/link/index');
            Route::get('add','LinkController@add')->name('/link/add');
            Route::post('doAdd','LinkController@doAdd');
            Route::post('changeStatus/{id}','LinkController@changeStatus');
            Route::get('edit/{id}','LinkController@edit');
            Route::put('doEdit','LinkController@doEdit');
            Route::delete('delete/{id}','LinkController@delete');
        });


        //文章管理
        Route::group(['prefix'=>'article'],function() {
            Route::get('index','ArticleController@index')->name('/article/index');
            Route::get('add','ArticleController@add')->name('/article/add');
            Route::post('doAdd','ArticleController@doAdd');
            Route::post('changeStatus/{id}','ArticleController@changeStatus');
            Route::get('edit/{id}','ArticleController@edit');
            Route::put('doEdit','ArticleController@doEdit');
            Route::delete('delete/{id}','ArticleController@delete');
        });
    });
});