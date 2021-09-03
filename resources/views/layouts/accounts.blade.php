@extends('layouts.app') 
@push('css')
<link rel="stylesheet" href="{{asset('css/accounts.css')}}">
@endpush
@section('content') 
    <div class="content">
    <div class="edit-form clr" >
    <div class="edit-form__left">
        <ul class="cs">
        <a href="{{route('profile.edit')}}"><li class="{{ Route::currentRouteName() == 'profile.edit' ? 'activate' : 'noactivate'}}">{{__('translate.Edit Profile')}}</li></a>
           <a href="{{route('password.edit')}}"> <li class="{{ Route::currentRouteName() == 'password.edit' ? 'activate' : 'noactivate'}}">{{__('translate.Change Password')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Apps and Websites')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Email and SMS')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Notifications')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Manage Contacts')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Privacy and Security')}}</li></a>
            <a href="{{ route('login-activity') }}"><li class="{{ Route::currentRouteName() == 'login-activity' ? 'activate' : 'noactivate'}}">{{__('translate.Login Activity')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Emails from Instagram')}}</li></a>
        </ul>
    </div>
    
    <div class="edit-form__right">
        @yield('contents') 
    </div><br>
    </div>
    </form>
    </div>     
</div><br>
 
    <footer style="width:80%;">
      <ul style="float:right">
         <li class=" "><a href="">{{ __('translate.About')}}</a></li>
         <li class=" "><a href="">Blog</a></li>
         <li class=" "><a href="">{{ __('translate.Jobs')}}</a></li>
         <li class=" "><a href="">{{ __('translate.Help')}}</a></li>
         <li class=" "><a href="">API</a></li>
         <li class=" "><a href="">{{ __('translate.Privacy')}}</a></li>
         <li class=" "><a href="">{{ __('translate.Terms')}}</a></li>
         <li class=" "><a href="">{{ __('translate.Top Accounts')}}</a></li>
         <li class=" "><a href="">Hashtag</a></li>
         <li class=" "><a href="">{{ __('translate.Locations')}}</a></li>
         <li class=" "><a href="{{route('language',['vi']) }}">Tiếng Việt</a></li>
         <li class=" "><a href="{{route('language',['en']) }}">English</a></li>
      </ul>
      <br> 
   </footer> 
@endsection
@push('js')
<script src="{{ asset('js/avatar.js') }}" ></script> 

@endpush