@extends('twilio.messages.shared.users')
@section('chat')
    <div class="top-right clr  ">
        <div class="user">
            <a href="{{route('get.home-page', $otherUser->user)}}">
                <img src="{{ pare_url_file($otherUser->avatar, 'user') }}" class="rounded-circle ">
                {{ $otherUser->c_name}}
            </a>
            <onlineuser v-bind:friend="{{ $otherUser }}" v-bind:onlineusers="onlineUsers"></onlineuser>
        </div>
    </div>
    <conversation-component :auth-user="{{ auth()->user() }}" :other-user="{{ $otherUser }}"></conversation-component>

@endsection  