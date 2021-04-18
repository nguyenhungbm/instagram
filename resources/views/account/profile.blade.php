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
                <form method="POST" enctype="multipart/form-data" id="form_upload_user_avatar">
                    @csrf
                    <input type="file" onchange="uploadUserAvatar(this,'form_upload_user_avatar')" accept="image/*"  name="upload_user_avatar" class="d-none" id="upload_user_avatar">
                </form>
                <div class="edit-form__content userr">  
                    <p class="">{{\Auth::user()->user}}</p><br>
                    <p class="text-blue cs" style="padding-left:10px" id="myBtn-5" >{{ __('translate.Change Profile Photo')}}</p>
                </div>
                </div>
                  <!-- modal user image -->
      <div id="myModal-5" class="modal">
         <div class="modal-content setting animate__animated animate__zoomIn" >
            <li class="hed"><a href="javascript:;" >{{ __('translate.Change Profile Photo')}}</a></li>
            <li>
               <label for="change_user" class="text-blue change cs">{{ __('translate.Upload Photo')}}</label>
               <form method="POST" enctype="multipart/form-data" id="form_change_user_avatar">
                  @csrf
                  <input type="file" onchange="uploadUserAvatar(this,'form_change_user_avatar')" accept="image/*"  name="upload_user_avatar" class="d-none" id="change_user">
               </form>
            </li>
            <li><a href="javascript:;" class="text-red remove_current_photo">{{ __('translate.Remove Current Photo')}}</a></li>
            <li class="cs" id="exit5"><a href="javascript:;">{{ __('translate.Cancel')}}</a></li>
         </div>
      </div>

           <form action="{{ route('profile.store')}}" method="POST" class="form-question">
               @csrf
           <div class="clr">
                <div class="edit-form__title">
                    <b>{{ __('translate.Name') }}</b>
                </div>
                <div class="edit-form__content">
                    <input type="text" name="c_name" value="{{\Auth::user()->c_name}}" placeholder="Name">
                    <p class="os f-11">{{ __("translate.Help people discover your account by using the name you're known by: either your full name, nickname, or business name.You can only change your name twice within 14 days") }}.</p>
                </div>
            </div>

            <div class="clr">
                <div class="edit-form__title">
                    <b>{{ __('translate.Username') }}</b>
                </div>
                <div class="edit-form__content">
                    <input type="text" name="user" value="{{\Auth::user()->user}}" placeholder="{{ __('translate.Username') }}">
                    <p class="os f-11">{{ __("translate.In most cases, you'll be able to change your username back to") }}{{\Auth::user()->user}}{{ __("translate.for another 14 days.") }}</p>
                </div>
            </div>

            <div class="clr">
                <div class="edit-form__title">
                    <b>{{ __('translate.Website') }}</b>
                </div>
                <div class="edit-form__content"> 
                    <input type="text" name="website" placeholder="{{ __('translate.Website') }}" value="{{\Auth::user()->website}}">
                </div>
            </div>

            <div class="clr">
                <div class="edit-form__title">
                    <b>{{ __('translate.Bio') }}</b>
                </div>
                <div class="edit-form__content">  
                    <textarea name="bio" >{{\Auth::user()->bio}}</textarea><br>
                    <p class="os f-11" style="font-weight:700">{{ __('translate.Personal Information') }}</p><br>
                    <p class="os f-11">{{ __("translate.your personal information, even if the account is used for a business, a pet or something else. This won't be a part of your public profile.") }}</p>
            </div>

            <div class="clr">
                <div class="edit-form__title">
                    <b>Email</b>
                </div>
                <div class="edit-form__content"> 
                    <input type="text" name="email" placeholder="Email" value="{{\Auth::user()->email}}">
                </div>
            </div>

            <div class="clr">
                <div class="edit-form__title">
                    <b>{{ __('translate.Phone Number') }}</b>
                </div>
                <div class="edit-form__content">  
                    <input type="text" name="phone" placeholder="Phone Number" value="{{\Auth::user()->phone}}">
                    <button class="background-blue button">{{ __('translate.Confirm Phone Number') }}</button>   
                </div> 
            </div>
            @php
            $val = __('translate.Male');
            if(\Auth::user()->gender==2)
            $val = __('translate.Female');
            elseif(\Auth::user()->gender==3)
            $val = __('translate.Custom');
            elseif(\Auth::user()->gender==4)
            $val = __('translate.Prefer Not To Say');
            @endphp
            <div class="clr">
                <div class="edit-form__title">  
                    <b>{{ __('translate.Gender')}}</b>  
                </div>
                <div class="edit-form__content"> 
                <input type="text" name="gender" placeholder="Email"  id="myBtn-6" value="{{ $val}}" readonly>
              
               </div> 
            </div>  
            <div  id="myModal-6" class="modal"> 
         <div class="modal-content setting animate__animated animate__zoomIn" >
            <li><a href="javascript:;" >{{ __('translate.Gender')}}</a></li> 
            <div class="clr gender">
            <div>
                    <input type="radio" class="gender" name="gender" value="1" {{ \Auth::user()->gender ==1 ? "checked" : ''}}>
                    <dd>{{ __('translate.Male')}}</dd>
                    <input type="radio" class="gender" name="gender" value="2" {{ \Auth::user()->gender ==2 ? "checked" : ''}}>
                    <dd>{{ __('translate.Female')}}</dd>
                    <input type="radio" class="gender" name="gender" value="3" {{ \Auth::user()->gender ==3 ? "checked" : ''}}>
                    <dd>{{ __('translate.Custom')}}</dd>
                    <input type="radio" class="gender" name="gender" value="4"{{ \Auth::user()->gender ==4 ? "checked" : ''}}>
                    <dd>{{ __('translate.Prefer Not To Say')}}</dd> 
            </div>
            <div>  
         </div>
      </div>

            <div class="text-center"> 
                <button type="submit" class="background-blue update_gender buttons">
                    <p>{{ __('translate.Submit')}}</p>
                    <img src="{{ asset('img/loading.gif')}}" class=" uploadavatars" style="display:none;">
                </button>  
            </div><br>
            </div> 
        </div>
         
        <div class="text-center"> 
                    <button class="background-blue button">{{ __('translate.Submit')}}</button> 
                
            </div>
    
      
@endsection