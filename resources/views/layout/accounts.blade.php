<link rel="stylesheet" href="{{asset('css/accounts.css')}}">
@include('header') 
<body>
    <div class="content">
    <div class="edit-form clr" >
    <div class="edit-form__left">
        <ul class="cs">
        <a href="{{route('profile.edit')}}"><li class="{{$title == 'Edit Profile' ? 'activate' : 'noactivate'}}">{{__('translate.Edit Profile')}}</li></a>
           <a href="{{route('password.edit')}}"> <li class="{{$title == 'Change Password' ? 'activate' : 'noactivate'}}">{{__('translate.Change Password')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Apps and Websites')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Email and SMS')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Notifications')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Manage Contacts')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Privacy and Security')}}</li></a>
            <a href="javascript:;"><li>{{__('translate.Login Activity')}}</li></a>
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
<script src="{{ asset('js/modal.js') }}"></script>  
<script src="{{ asset('js/avatar.js') }}"></script>
</body>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script>

    if(typeof TYPE_MESSAGE != "undefined"){
        switch (TYPE_MESSAGE){
            case 'success':
                toastr.success(MESSAGE)
                break;
            case 'error':
                toastr.error(MESSAGE)
                break;
        }
    }

    
</script>