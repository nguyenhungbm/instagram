<meta name="roomId" content="{{ $room }}">
@extends('direct.form') 
@section('chat') 
<div class="top-right clr  ">
   <div class="user">
      <a href="#">
      <img src="{{ pare_url_file('ninja.jpg','user') }}"   class="rounded-circle ">
      {{ $group_room->name}}
      </a>
   </div>
   <div class="infos">
      <a href="" class="info"><i class="fa fa-lg fa-info"></i></a>
      <a href="{{route('chat.video')}}"><i class="fa fa-lg fa-video-camera"></i></a>
   </div>
</div>
<chat_group v-bind:chat_group="chat_group" v-bind:userid="{{ Auth::user()->id }}" v-bind:roomid="{{ $room }}"></chat_group>
@endsection