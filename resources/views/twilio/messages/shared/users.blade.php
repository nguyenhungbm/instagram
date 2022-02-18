<style>
body {
    height: 80%
}
</style>
@extends('layouts.app')
@section('content')
<div class="messages  d-block">
    <div class="left d-inline-block" style="height: 100%;width:35%; ">
        <div class="top-left  position-relative">
            <p>{{ \Auth::user()->c_name}} - {{ \Auth::user()->id}}</p>
        </div>
        <div class="bottom-left">
            <ul>
                @if(isset($users))
                @foreach($users as $list)
                @if($list->user_id == \Auth::id())
                <a href="{{ route('messages.chat', [ 'ids' => auth()->user()->id  . '-' . $list->friend_id ]) }}">
                    <li class="clr">
                        <img src="{{ pare_url_file($list->avatar,'user') }}">
                        <p style="margin-top: 10px;">{{ $list->c_name}}</p> <br>
                        <onlineuser v-bind:friend="{{$list }}" v-bind:onlineusers="onlineUsers"></onlineuser>
                    </li>
                </a>
                @else
                <a href="{{ route('messages.chat', [ 'ids' => auth()->user()->id  . '-' . $list->id ]) }}">
                    <li class="clr">
                        <img src="{{ pare_url_file($list->avatar,'user') }}">
                        <p style="margin-top: 10px;">{{ $list->c_name}}</p> <br>
                        <onlineuser v-bind:friend="{{$list }}" v-bind:onlineusers="onlineUsers"></onlineuser>
                    </li>
                </a>
                @endif
                @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="rights d-inline-block" style="height: 100%;width:65%;background-color: white; ">
        @yield('chat')
    </div>
</div>
@endsection 