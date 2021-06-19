<?php

use Illuminate\Support\Facades\Route;
 
Auth::routes();     

//admin-auth
Route::group(['prefix' =>'admin-auth','namespace' => 'Admin\Auth'], function() {
    Route::get('login','AdminController@getLoginAdmin')->name('get.login.admin');
    Route::post('login','AdminController@postLoginAdmin');
    Route::get('register','AdminController@getRegisterAdmin')->name('get.register.admin');
    Route::post('register','AdminController@postRegisterAdmin');
    Route::get('logout','AdminController@getLogoutAdmin')->name('get.logout.admin');
});
Route::group(['prefix'=>'api-admin','namespace'=>'Admin','middleware'=>'check_admin_login'],function(){
    Route::get('','HomeController@index')->name('home.index');  
    Route::group(['prefix'=>'user'],function(){
        Route::get('list-user','HomeController@list')->name('admin.user.list');
        Route::get('block_user/{id}','HomeController@block_user')->name('admin.user.block')->middleware('check_admin_permission:block-user'); 
        Route::get('delete/{id}','HomeController@delete')->name('admin.user.delete'); 
    });

    Route::resources([
        'admin'      => 'AdminController',
        'role'       => 'RoleController',
        'permission' => 'PermissionController',
    ]);
 
    Route::resource('post', 'PostController')->only([
        'index', 'destroy'
    ]); 
});