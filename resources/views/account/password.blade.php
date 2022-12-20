<style>
    @media only screen and (max-width: 670px) {
        body {
            background: #ffff !important;
        }

        .edit-form, .edit-form__right {
            border: none !important
        }
    }
</style>
@extends('layouts.accounts')
@section('contents')
    <div class="w-80">
        <div class="d-flex" style="justify-content:center">
            @include('layout.avatar',['user' =>Auth::user(), 'height'=>'40px'])
            <div style="padding: 15px 25px;">
                <b>{{Auth::user()->c_name}}</b><br>
                <p>{{Auth::user()->user}}</p>
            </div>
        </div>
        <div class="clr">
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
                        <button type="submit"
                                class="background-blue button">{{ __('translate.Change Password') }}</button>
                    </div>
                </div>
        </div>
        </form>
@endsection 