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
    Route::get('user','HomeController@user')->name('admin.user');
    Route::get('post','HomeController@post')->name('admin.post');
    Route::resources([
        'admin'      => 'AdminController',
        'role'       => 'RoleController',
        'permission' => 'PermissionController',
    ]); 
}); 