@extends('layout.accounts')
@section('contents')
<div class="w-80">
    <div class="clr">
        <div class="edit-form__title">
            @if(!\Auth::user()->avatar) 
        <label for="upload_user_avatar"> <img src="/img/no-user.png" class="rounded-circle cs avatar_user_uploaded"></label>
                
            @elseif(substr(\Auth::user()->avatar,0,4)=='http')
        <img src="{{ \Auth::user()->avatar }}" class="rounded-circle cs avatar_user_uploaded" id="myBtn-5">
            @else
        <img src="{{ pare_url_file(\Auth::user()->avatar,'user') }}" class="rounded-circle  cs avatar_user_uploaded" id="myBtn-5">
            @endif
        <img src="{{ asset('img/loading.gif')}}" class=" uploadavatar imguser" style="display:none;">
                
        </div> 
        <div class="edit-form__content userr">  
            <p>{{\Auth::user()->user}}</p><br>
                     
        </div>
        <form action="{{ route('password.store')}}" method="POST">
            @csrf
        <div class="clr">
            <div class="edit-form__title">
                <b>{{ __('translate.Old Password') }}</b>
            </div>
            <div class="edit-form__content"> 
                <input type="password" name="oldpassword" class="background-gray">
            </div>
        </div>

        <div class="clr">
            <div class="edit-form__title">
                <b>{{ __('translate.New Password') }}</b>
            </div>
            <div class="edit-form__content"> 
                <input type="password" name="password" class="background-gray">
            </div>
        </div>

        <div class="clr">
            <div class="edit-form__title">
                <b>{{ __('translate.Confirm New Password') }}</b>
            </div>
            <div class="edit-form__content"> 
                <input type="password" name="re_password" class="background-gray">
            </div>
        </div>

        <div class="clr">
            <div class="edit-form__title">
                <b></b>
            </div>
            <div class="edit-form__content"> 
                <button type="submit" class="background-blue button">{{ __('translate.Change Password') }}</button>
            </div>
        </div>

        <div class="clr">
            <div class="edit-form__title">
                <b></b>
            </div>
            <div class="edit-form__content"> 
               <a href="" class="text-blue">{{ __('translate.Forgot Password?') }}</a>
            </div>
        </div>
        </div>
</form>
@endsection 