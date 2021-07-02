<?php

use Illuminate\Support\Facades\Route;

Auth::routes();     
include('route-admin.php'); 

Route::get('/data','App\Http\Controllers\HomeController@data'); 

Route::get('/offline', function () {    
    return view('vendor/laravelpwa/offline');
    });
Route::get('/','App\Http\Controllers\HomeController@index')->name('home')->middleware('auth'); 
Route::get('/search','App\Http\Controllers\HomeController@search')->name('search'); 
 Route::group(['namespace' =>'App\Http\Controllers\Auth','prefix'=>'account'],function(){
    Route::get('forgot-password','ResetPasswordController@getFormPassword')->name('get.forgot-password'); // quên mật khẩu
    Route::post('forgot-password','ResetPasswordController@postPassword'); // xử lý quên mật khẩu
   
    Route::get('register','RegisterController@getFormRegister')->name('get.register'); // đăng ký
    Route::post('register','RegisterController@create'); // xử lý đăng ký
 
    Route::get('verify/{user}','RegisterController@getVerifyAccount')->name('user.verify.gmail');//xác thực qua email
    Route::get('verify-phone','RegisterController@getVerifyMessage')->name('user.verify.message');//xác thực qua tin nhắn
    Route::post('verify-phone','RegisterController@postVerifyMessage');//xác thực qua tin nhắn

    Route::get('login','LoginController@getFormLogin')->name('get.login'); // đăng nhập
    Route::post('login','LoginController@postLogin'); // xử lý đăng nhập
    
    Route::get('accounts/password/reset','ResetPasswordController@changePassword')->name('user.change.password'); // thay đổi mật khẩu
    Route::post('accounts/password/reset','ResetPasswordController@StorePassword'); // thay đổi mật khẩu 

    Route::get('logout','LoginController@getLogout')->name('get.logout'); // đăng xuất  
});
//chat
Route::group(['namespace'=>'App\Http\Controllers\Personal','middleware' => 'auth'], function () {   
    Route::get('/explore','ExploreController@index')->name('explore'); 
    Route::get('/direct','DirectController@index')->name('direct');   
    //tìm kiếm
    Route::get('/searchmess','DirectController@searchmess')->name('searchmess'); 
    //lấy người dùng tạo group chat 
    Route::get('/direct/a/','DirectController@create_chat_group')->name('create_chat_group'); 
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
Route::group(['namespace'=>'App\Http\Controllers\Page','middleware' => 'auth'], function () { 
    //follow user
    Route::get('qr_code/{slug}', 'QRController@create')->name('qrcode');
    Route::post('/upload','PostController@savePost')->name('post.profile'); 
    Route::get('/incre-view','PostController@increView')->name('post.increview'); 
    Route::post('/follow','FollowController@follow'); 
    Route::post('/upload_user','AvatarController@uploadAvatar')->name('upload.user'); 
    Route::get('/delete','AvatarController@deleteAvatar')->name('post.delete');
    Route::get('/{user}','HomePageController@index')->name('get.home-page');   
    
}); 

Route::get('/auth/redirect/{provider}', 'App\Http\Controllers\SocialController@redirect');
Route::get('/callback/{provider}', 'App\Http\Controllers\SocialController@callback');

Route::group(['namespace'=>'App\Http\Controllers\Activate'], function () {   
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
Route::get('/p/{slug}','App\Http\Controllers\Account\PostController@view_post')->name('post.view'); 
Route::group(['prefix'=>'accounts','namespace'=>'App\Http\Controllers\Account'], function () {   
    Route::get('/edit','ProfileController@edit')->name('profile.edit');  
    Route::post('/edit/store','ProfileController@store')->name('profile.store');    
    Route::get('/edit/password','ProfileController@password')->name('password.edit'); 
    Route::post('/edit/password/store','ProfileController@store_password')->name('password.store');  
    Route::get('/confirm','ProfileController@ConfirmPhone')->name('confirm'); // quên mật khẩu
});

Route::group(['prefix'=>'sms'], function () {   
    Route::post('/sms','App\Http\Controllers\TwilioController@sms')->name('twilio.sms');  
    Route::post('/voice','App\Http\Controllers\TwilioController@voice')->name('twilio.voice');    
});
