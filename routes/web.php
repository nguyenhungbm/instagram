<?php

use Illuminate\Support\Facades\Route;

include('route-admin.php'); 

Route::get('/data','HomeController@data'); 
Route::post('/data','HomeController@save')->name('data'); 

Route::get('/offline', function () {    
    return view('vendor/laravelpwa/offline');
    });
Auth::routes();     
Route::get('/','HomeController@index')->name('home')->middleware('auth'); 
Route::get('/search','HomeController@search')->name('search'); 
Route::get('/address','HomeController@getAddress')->middleware('auth'); 
Route::post('/address','HomeController@storeAddress')->middleware('auth'); 

Route::group(['prefix'=>'line'],function(){
    Route::get('/login','LiffController@login')->name('liff'); 
    Route::get('/chatbot','LiffController@chatbot')->name('chatbot'); 

});
Route::group(['namespace' =>'Auth','prefix'=>'account'],function(){
    Route::get('/login/qr/','LoginController@loginByToken')->name('login.qr'); 
    Route::get('verify/{user}','RegisterController@getVerifyAccount')->name('user.verify.gmail');//xác thực qua email
    Route::get('verify-phone','RegisterController@getVerifyMessage')->name('user.verify.message');//xác thực qua tin nhắn
    Route::post('verify-phone','RegisterController@postVerifyMessage');//xác thực qua tin nhắn
        
    Route::get('accounts/password/reset','ResetPasswordController@changePassword')->name('user.change.password'); // thay đổi mật khẩu
    Route::post('accounts/password/reset','ResetPasswordController@StorePassword'); // thay đổi mật khẩu 
});
//chat
Route::group(['namespace'=>'Personal','middleware' => 'auth'], function () {   
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
    // Route::post('/pusher/auth', 'HomeController@authenticate'); 
   
}); 
//home page
Route::group(['namespace'=>'Page','middleware'=>'auth'], function () { 
    //follow user
    Route::get('/qr/login', 'QRController@login');
    Route::post('/upload','PostController@savePost')->name('post.profile'); 
    Route::get('/incre-view','PostController@increView')->name('post.increview'); 
    Route::post('/follow','FollowController@follow'); 
    Route::post('/upload_user','AvatarController@upload')->name('upload.user'); 
    Route::get('/delete','AvatarController@delete')->name('post.delete');
    Route::get('qr_code/{slug}', 'QRController@create')->name('qrcode');
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
Route::get('/p/{slug}','Account\PostController@view_post')->name('post.view')->middleware('auth'); 
Route::get('/p/{slug}/delete','Account\PostController@delete')->name('post.delete')->middleware('auth'); 
Route::group(['prefix'=>'accounts','namespace'=>'Account'], function () {   
    Route::get('/edit','ProfileController@edit')->name('profile.edit');  
    Route::post('/edit/store','ProfileController@store')->name('profile.store');    
    Route::get('/edit/password','ProfileController@password')->name('password.edit'); 
    Route::post('/edit/password/store','ProfileController@store_password')->name('password.store');  
    Route::get('/confirm','ProfileController@ConfirmPhone')->name('confirm'); // quên mật khẩu
    Route::get('/login-activity','ProfileController@LoginActivity')->name('login-activity'); // quên mật khẩu
});

Route::group(['prefix'=>'twilio'], function () {  
    Route::get('list', 'Twilio\ChatController@index')->name('twilio.list');
    Route::get('chat/{ids}', 'Twilio\ChatController@chat')->name('messages.chat');
    Route::get('video', 'Twilio\VideoController@video');
 
    Route::post('/sms','TwilioController@sms')->name('twilio.sms');  
    Route::post('/voice','TwilioController@voice')->name('twilio.voice');    
});
 