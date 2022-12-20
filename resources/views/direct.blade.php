@extends('direct.form')
@section('chat')
    <div class="rights d-inline-block" style="height: 100%;width:65%;background-color: white; ">
        <div class="d-flex we">
            <img src="{{asset('img/direct-content.png')}}">
            <p>{{ __('translate.Your Messages')}}</p>
            <p class="os">{{ __('translate.Send private photos and messages to a friend or group.')}}</p>
            <button class="openmodal">{{ __('translate.Send Message')}}</button>
        </div>
    </div>
@endsection