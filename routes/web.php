<?php

use Illuminate\Support\Facades\Route;
 
Auth::routes();     
include('route-admin.php'); 

Route::get('/test','BlogController@getArticles'); 

Route::get('/','HomeController@index')->name('home')->middleware('auth'); 
Route::get('/search','HomeController@search')->name('search')->middleware('auth'); 
 Route::group(['namespace' =>'Auth','prefix'=>'account'],function(){
    Route::get('register','RegisterController@getFormRegister')->name('get.register'); // đăng ký
    Route::post('register','RegisterController@create'); // xử lý đăng ký


    Route::get('verify/{user}','RegisterController@getVerifyAccount')->name('user.verify.gmail');//xác thực qua email
    Route::get('verify-phone','RegisterController@getVerifyMessage')->name('user.verify.message');//xác thực qua tin nhắn
    Route::post('verify-phone','RegisterController@postVerifyMessage');//xác thực qua tin nhắn

    Route::get('login','LoginController@getFormLogin')->name('get.login'); // đăng nhập
    Route::post('login','LoginController@postLogin'); // xử lý đăng nhập
    
    Route::get('forgot-password','ResetPasswordController@getFormPassword')->name('get.forgot-password'); // quên mật khẩu
    Route::post('forgot-password','ResetPasswordController@postPassword'); // xử lý quên mật khẩu
    Route::get('accounts/password/reset','ResetPasswordController@changePassword')->name('user.change.password'); // thay đổi mật khẩu
    Route::post('accounts/password/reset','ResetPasswordController@StorePassword'); // thay đổi mật khẩu

    Route::get('logout','LoginController@getLogout')->name('get.logout'); // đăng xuất

});
//chat
Route::group(['namespace'=>'Personal'], function () {   
    Route::get('/explore','ExploreController@index')->name('explore'); 
    Route::get('/direct','DirectController@index')->name('direct');   
    //tìm kiếm
    Route::get('/searchmess','DirectController@searchmess')->name('searchmess'); 
    //lấy người dùng tạo group chat 
    Route::post('/direct/a/','DirectController@create_chat_group')->name('create_chat_group'); 
    //chat group
    Route::get('/direct/t/{room}', 'DirectController@index_chat_group')->name('chat.group.show');
    Route::post('/group_chat/getGroupChat/{room}', 'DirectController@getGroupChat');
    Route::post('/group_chat/sendChat', 'DirectController@sendGroupChat');
   
    //chat private
    Route::get('/direct/{id}', 'DirectController@show')->name('chat.show');
    Route::post('/chat/getChat/{id}', 'DirectController@getChat');
    Route::post('/chat/sendChat', 'DirectController@sendChat');
    //call video
    Route::get('/video',  'DirectController@video')->name('chat.video');
    // Route::post('/pusher/auth', 'HomeController@authenticate'); 
   
}); 
//home page
Route::group(['namespace'=>'Page'], function () { 
    //follow user
    Route::get('/incre-view','HomePageController@incre_view')->name('post.increview'); 
    Route::post('/follow','HomePageController@follow'); 
    Route::post('/upload_user','HomePageController@uploadProfile')->name('upload.user'); 
    Route::get('/delete','HomePageController@deleteProfile')->name('post.delete');
    Route::post('/upload','HomePageController@saveProfile')->name('post.profile'); 
    Route::get('/{user}','HomePageController@index')->name('get.home-page');   
    
});

Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::group(['namespace'=>'Activate'], function () {   
    // post image
    Route::get('/like/post','PostImage@LikePost')->name('like.post'); 
    Route::post('/comment/post','PostImage@CommentPost')->name('comment.post');  
    Route::get('/share/post','PostImage@SharePost')->name('share.post');  
    //post video
    Route::get('/upload/video','PostVideo@UploadVideo')->name('upload.video'); 
    Route::post('/upload/video','PostVideo@StoreVideo'); 
    Route::get('/like/video','PostVideo@LikeVideo')->name('like.video'); 
    Route::get('/comment/video','PostVideo@CommentVideo')->name('comment.video');  
    Route::get('/share/video','PostVideo@ShareVideo')->name('share.video');  
    //change languge 
    Route::get('/language/{language}','LanguageController@index')->name('language');
    //notification
    Route::post('/notification/get','NotificationController@index'); 
    Route::post('/notification/read','NotificationController@read'); 
 
});
//chi tiết bài viết
Route::get('/p/{slug}','Account\PostController@view_post')->name('post.view'); 
Route::group(['prefix'=>'accounts','namespace'=>'Account'], function () {   
    Route::get('/edit','ProfileController@edit')->name('profile.edit');  
    Route::post('/edit/store','ProfileController@store')->name('profile.store');    
    Route::get('/edit/password','ProfileController@password')->name('password.edit'); 
    Route::post('/edit/password/store','ProfileController@store_password')->name('password.store');  

});
