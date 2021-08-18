<style>
@media only screen and (max-width: 670px){
body{
    background: #ffff !important;
    }
.edit-form,.edit-form__right{
    border:none !important
}
.edit-form__right { 
    padding-top: 0px !important;
}
}
</style>
@extends('layouts.accounts')
@section('contents')
<div class="w-80">
    <div class="d-flex" style="justify-content:center">
        @include('layout.avatar',['user' =>\Auth::user(),'height'=>'40px'])
        <div style="padding: 15px 25px;">
            <b>{{\Auth::user()->c_name}}</b><br>
            <p>{{\Auth::user()->user}}</p>
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
            <form action="confirm" method="get">
            <input type="text" name="phone" placeholder="Phone Number" value="{{\Auth::user()->phone}}">
            <button class="background-blue button" type="submit">{{ __('translate.Confirm Phone Number') }}</button>
            </form>   
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
            <input type="text" name="gender" class="cs" placeholder="Email"  id="myBtn-6" value="{{ $val}}" readonly>
        </div> 
    </div>  
    <div id="myModal-6" class="modal"> 
        <div class="modal-content setting animate__animated animate__zoomIn" >
            <li><a href="javascript:;" >{{ __('translate.Gender')}}</a></li> 
            <div class="clr gender">
                <div>
                    <input type="radio" id="one" class="gender" name="gender" value="1" {{ \Auth::user()->gender ==1 ? "checked" : ''}}>
                    <label for="one">{{ __('translate.Male')}}</label><br>
                    <input type="radio" id="two" class="gender" name="gender" value="2" {{ \Auth::user()->gender ==2 ? "checked" : ''}}>
                    <label for="two">{{ __('translate.Female')}}</label><br>
                    <input type="radio" id="three" class="gender" name="gender" value="3" {{ \Auth::user()->gender ==3 ? "checked" : ''}}>
                    <label for="three">{{ __('translate.Custom')}}</label><br>
                    <input type="radio" id="four" class="gender" name="gender" value="4"{{ \Auth::user()->gender ==4 ? "checked" : ''}}>
                    <label for="four">{{ __('translate.Prefer Not To Say')}}</label> <br>
                </div>
            <div>  
        </div>
    </div>

    <div class="text-center"> 
        <button type="submit" class="background-blue update_gender buttons">
            <span>{{ __('translate.Submit')}}</span>
            <img src="{{ asset('img/loading.gif')}}" class="uploadavatars w-30" style="display:none;">
        </button>  
    </div><br>
</div> 
</div>
         
<div class="text-center"> 
    <button class="background-blue button">{{ __('translate.Submit')}}</button> 
</div>
@endsection