<?php

use Illuminate\Support\Facades\Route;
 
Auth::routes();     

//admin-auth
Route::group(['prefix' =>'admin-auth','namespace' => 'App\Http\Controllers\Admin\Auth'], function() {
    Route::get('login','AdminController@getLoginAdmin')->name('get.login.admin');
    Route::post('login','AdminController@postLoginAdmin');

    Route::get('register','AdminController@getRegisterAdmin')->name('get.register.admin');
    Route::post('register','AdminController@postRegisterAdmin');


    Route::get('logout','AdminController@getLogoutAdmin')->name('get.logout.admin');
});
Route::group(['prefix'=>'api-admin','namespace'=>'App\Http\Controllers\Admin','middleware'=>'check_admin_login'],function(){
    Route::get('','AdminController@index')->name('admin.index'); 
    Route::group(['prefix'=>'admin'],function(){
        Route::get('','EmployeeController@index')->name('admin.employee.index');
        Route::get('create','EmployeeController@create')->name('admin.employee.create');
        Route::post('create','EmployeeController@store')->middleware('check_admin_permission:create-admin');
        Route::get('update/{id}','EmployeeController@edit')->name('admin.employee.update');
        Route::post('update/{id}','EmployeeController@update')->middleware('check_admin_permission:edit-admin');
        Route::get('delete/{id}','EmployeeController@delete')->name('admin.employee.delete')->middleware('check_admin_permission:del-admin'); 
    });

    Route::group(['prefix'=>'user'],function(){
        Route::get('list-user','AdminController@list')->name('admin.user.list');
        Route::get('block_user/{id}','AdminController@block_user')->name('admin.user.block')->middleware('check_admin_permission:block-user'); 
        Route::get('delete/{id}','AdminController@delete')->name('admin.user.delete'); 
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