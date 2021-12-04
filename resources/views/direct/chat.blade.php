<meta name="friendId" content="{{ $friend->id }}">
@extends('direct.form')
@section('chat')
<div class="top-right clr  ">
   <div class="user">
      <a href="{{route('get.home-page',$friend->user)}}">
         <img src="{{ pare_url_file($friend->avatar,'user') }}"   class="rounded-circle ">
         {{ $friend->c_name}}
      </a>
      <onlineuser v-bind:friend="{{ $friend }}" v-bind:onlineusers="onlineUsers"></onlineuser>
        <a href="{{ route('chat.video') }}"></a>
   </div> 
</div>
<chat v-bind:chats="chats" v-bind:userid="{{ Auth::user()->id }}" v-bind:friendid="{{ $friend->id }}" ></chat>
 
@endsection