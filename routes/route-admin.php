<?php

use Illuminate\Support\Facades\Route;
 
Auth::routes();     

//admin-auth
Route::group(['prefix' =>'admin-auth','namespace' => 'Admin\Auth'], function() {
    Route::get('login','HomeController@getLoginAdmin')->name('get.login.admin');
    Route::post('login','HomeController@postLoginAdmin');

    Route::get('register','HomeController@getRegisterAdmin')->name('get.register.admin');
    Route::post('register','HomeController@postRegisterAdmin');

    Route::get('logout','HomeController@getLogoutAdmin')->name('get.logout.admin');
});
Route::group(['prefix'=>'api-admin','namespace'=>'Admin','middleware'=>'check_admin_login'],function(){
    Route::get('','HomeController@index')->name('admin.index'); 
    Route::group(['prefix'=>'admin'],function(){
        Route::get('','AdminController@index')->name('admin.employee.index');
        Route::get('create','AdminController@create')->name('admin.employee.create');
        Route::post('create','AdminController@store')->middleware('check_admin_permission:create-admin');
        Route::get('update/{id}','AdminController@edit')->name('admin.employee.update');
        Route::post('update/{id}','AdminController@update')->middleware('check_admin_permission:edit-admin');
        Route::get('delete/{id}','AdminController@delete')->name('admin.employee.delete')->middleware('check_admin_permission:del-admin'); 
    });

    Route::group(['prefix'=>'user'],function(){
        Route::get('list-user','HomeController@list')->name('admin.user.list');
        Route::get('block_user/{id}','HomeController@block_user')->name('admin.user.block')->middleware('check_admin_permission:block-user'); 
        Route::get('delete/{id}','HomeController@delete')->name('admin.user.delete'); 
    });

    Route::group(['prefix'=>'permission'],function(){
       
        Route::get('','PermissionController@index')->name('admin.permission.index');
        Route::get('create','PermissionController@create')->name('admin.permission.create');
        Route::post('create','PermissionController@store');
        Route::get('update/{id}','PermissionController@update')->name('admin.permission.update');
        Route::post('update/{id}','PermissionController@edit');
        Route::get('delete/{id}','PermissionController@delete')->name('admin.permission.delete'); 
    });

    Route::group(['prefix'=>'role'],function(){
        Route::get('','RoleController@index')->name('admin.role.index');
        Route::get('create','RoleController@create')->name('admin.role.create');
        Route::post('create','RoleController@store');
        Route::get('update/{id}','RoleController@update')->name('admin.role.update');
        Route::post('update/{id}','RoleController@edit');
        Route::get('delete/{id}','RoleController@delete')->name('admin.role.delete'); 
    });
    Route::group(['prefix'=>'post'],function(){
        Route::get('','PostController@index')->name('admin.post.index');
        Route::get('delete/{id}','PostController@delete')->name('admin.post.delete')->middleware('check_admin_permission:del-post'); 
    });
});