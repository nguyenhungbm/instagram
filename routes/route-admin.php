<?php

use Illuminate\Support\Facades\Route;
 
Auth::routes();     

//admin-auth
Route::group(['prefix' =>'admin-auth', 'namespace' => 'Admin\Auth'], function() {
    Route::get('login', 'AdminController@getLoginAdmin')->name('get.login.admin');
    Route::post('login', 'AdminController@postLoginAdmin');
    Route::get('register', 'AdminController@getRegisterAdmin')->name('get.register.admin');
    Route::post('register', 'AdminController@postRegisterAdmin');
    Route::get('logout', 'AdminController@getLogoutAdmin')->name('get.logout.admin');
});
Route::group(['prefix'=>'api-admin', 'namespace'=>'Admin', 'middleware'=>'check_admin_login'],function(){
    Route::get('', 'HomeController@index')->name('home.index');  
    Route::get('user', 'HomeController@user')->name('admin.user');
    Route::get('post', 'HomeController@post')->name('admin.post');

     Route::group(['prefix'=>'admin'],function(){
        Route::get('', 'AdminController@index')->name('admin.index');
        Route::get('create', 'AdminController@create')->name('admin.create');
        Route::post('create', 'AdminController@store')->name('admin.store')->middleware('check_admin_permission:create-admin');
        Route::get('update/{id}', 'AdminController@edit')->name('admin.edit');
        Route::put('update/{id}', 'AdminController@update')->name('admin.update')->middleware('check_admin_permission:edit-admin');
        Route::delete('delete/{id}', 'AdminController@destroy')->name('admin.destroy')->middleware('check_admin_permission:del-admin'); 
    });

    Route::group(['prefix'=>'user'],function(){
        Route::get('list-user', 'AdminController@list')->name('admin.user.list')->middleware('check_admin_permission:view-user');
        Route::get('block_user/{id}', 'AdminController@block_user')->name('admin.user.block')->middleware('check_admin_permission:block-user'); 
        Route::get('delete/{id}', 'AdminController@delete')->name('admin.user.delete'); 
    });

    Route::group(['prefix'=>'permission'],function(){
        Route::get('', 'PermissionController@index')->name('permission.index')->middleware('check_admin_permission:view-permission');
        Route::get('create', 'PermissionController@create')->name('permission.create');
        Route::post('create', 'PermissionController@store')->name('permission.store')->middleware('check_admin_permission:create-permission');
        Route::get('update/{id}', 'PermissionController@edit')->name('permission.edit');
        Route::put('update/{id}', 'PermissionController@update')->name('permission.update')->middleware('check_admin_permission:edit-permission');
        Route::get('delete/{id}', 'PermissionController@delete')->name('permission.delete')->middleware('check_admin_permission:del-permission'); 
    });

    Route::group(['prefix'=>'role'],function(){
        Route::get('', 'RoleController@index')->name('role.index')->middleware('check_admin_permission:view-role');
        Route::get('create', 'RoleController@create')->name('role.create');
        Route::post('create', 'RoleController@store')->name('role.store')->middleware('check_admin_permission:create-role');
        Route::get('update/{id}', 'RoleController@edit')->name('role.edit');
        Route::put('update/{id}', 'RoleController@update')->name('role.update')->middleware('check_admin_permission:edit-role');
        Route::delete('delete/{id}', 'RoleController@destroy')->name('role.destroy')->middleware('check_admin_permission:del-role'); 
    });
    Route::group(['prefix'=>'post'],function(){
        Route::get('', 'PostController@index')->name('post.index')->middleware('check_admin_permission:view-post');
        Route::get('delete/{id}', 'PostController@delete')->name('post.delete')->middleware('check_admin_permission:del-post'); 
    });
    Route::resources([
        // 'admin'      => 'AdminController',
        // 'role'       => 'RoleController',
        // 'permission' => 'PermissionController',
    ]); 
}); 
