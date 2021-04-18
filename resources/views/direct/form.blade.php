<style>
   body{height:80%}
</style>
@extends('header') 
@section('content') 
<div class="messages  d-block">
   <div class="left d-inline-block" style="height: 100%;width:35%; ">
      <div class="top-left  position-relative">
         <p>{{ \Auth::user()->c_name}}</p>
         <img src="{{ asset('img/direct-message.png') }}" class="openmodal cs">
      </div>
      <div class="bottom-left">
         <ul>
            @if(isset($friend->id))
            @if(!count(\App\Models\Chat::where(['user_id'=>\Auth::id(),'friend_id'=>$friend->id])->get())
            &&
            !count(\App\Models\Chat::where(['friend_id'=>\Auth::id(),'user_id'=>$friend->id])->get())
            )
            <a href="{{ route('chat.show', $friend->id) }}">
               <li class="clr">
                  <img src="{{ pare_url_file($friend->avatar,'user') }}">
                  <p>{{ $friend->c_name}}</p>
                  <br>
                  <onlineuser v-bind:friend="{{$friend }}" v-bind:onlineusers="onlineUsers"></onlineuser>
               </li>
            </a>
            @endif 
            @endif
            @if(isset($chat))
            @foreach($chat as $list)
            @php
            $userr =$list->friends;
            if( $list->friends->id == \Auth::id())
            $userr =$list->users;
            @endphp
            <a href="{{ route('chat.show', $userr->id) }}">
               <li class="clr" >
                  <img src="{{ pare_url_file($userr->avatar,'user') }}">
                  <p>{{ $userr->c_name}}</p>
                  <br>
                  <onlineuser v-bind:friend="{{ $userr }}" v-bind:onlineusers="onlineUsers"></onlineuser>
               </li>
            </a>
            @endforeach  
            @endif
            @if(isset($group))
            @foreach($group as $value)  
            <a href="{{ route('chat.group.show', $value->room) }}">
               <li class="clr" >
                  <img src="{{ pare_url_file('ninja.jpg','user') }}">
                  <p>{{$value->name}}</p>
                  <br>
               </li>
            </a>
            @endforeach  
            @endif
         </ul>
      </div>
   </div>
   <div class="rights d-inline-block" style="height: 100%;width:65%;background-color: white; ">
      @yield('conten')
   </div>
</div>
<!-- <div id="id01" class="w3-modal d-none"> -->
<div id="id01" class="w3-modal d-none">
   <div class="w3-modal-content animate__flipInX d-flex po">
      <div class="clr pp">
         <span class="cs closemodal">&times;</span>
         <p>{{ __('translate.New Message')}}</p>
         <form action="{{route('create_chat_group')}}" method="post">
            @csrf
            <input type="hidden" name="user" id="add_user">
            <button class="disabled nexts">{{ __('translate.Next')}}</button>
         </form>
      </div>
      <div class="pi">
         @csrf
         <p class="pr">{{ __('translate.To')}}:</p>
         <div class="pe">
            <div class="d-flex pw">
            </div>
         </div>
         <input type="text" name="key" placeholder="{{ __('translate.Search')}}..." id="search" autocomplete="off">
      </div>
      <div class="pu ">
         <b class="pq">{{ __('translate.Suggested')}}</b>
         @foreach($chat as $key=>$list)
         @if($list->friends->id!=\Auth::id())
         <div class="clr py cs py{{$list->id}}">
            <img src="{{ pare_url_file($list->friends->avatar,'user')}}" class="rounded-circle">
            <div>
               <b>{{ $list->friends->user}}</b><br>
               <p class="os">{{$list->friends->c_name}}</p>
            </div>
            <button class="cs hihi{{$key}}"><i class="fa fa-lg fa-check haha{{$key}}"></i></button>
         </div>
         <script> 
            var users=new Array();
             $(function(){ 
               $('.py{{$list->id}}').on('click',function(){
                  if($('.hihi{{$key}}').hasClass('background-blue')){
                     $('.hihi{{$key}}').removeClass('background-blue'); 
                     $('.pt{{$key}}').remove();
                     if(!$('.pw').children('div').hasClass('pt')){
                     $('.nexts').addClass('disabled');
                     }
                     for( var i = 0; i < users.length; i++){ 
                     if ( users[i] === {{$list->friends->id}}) { 
                        users.splice(i, 1); 
                     }
                  }
                  }else{  
                     users.push({{$list->friends->id}});
                     $('.nexts').removeClass('disabled');
                  $('.hihi{{$key}}').addClass('background-blue'); 
                  $('.pw').append(` 
                  <div class="pt pt{{$key}}" id="pt{{$key}}">
                     <a href="javascript:;">{{$list->friends->user}} <span class="close{{$key}}">&times;</span></a> 
                  </div> 
                  `);
                  }
                  $('#add_user').val(users);
            
               });  
               $('body').on('click','.close{{$key}}',function(){
               $('.pt{{$key}}').remove();
               $('.hihi{{$key}}').removeClass('background-blue'); 
               if($('.pu button').hasClass("background-blue")){
               $('.nexts').removeClass('disabled');
                }else{
               $('.nexts').addClass('disabled');
                }  
               })  
             })
         </script> 
         @endif
         @endforeach 
      </div>
   </div>
</div>
<script>
   $(function(){
      $('body').on('click','.pu button',function(){
      if($('.pu button').hasClass("background-blue")){
         $('.nexts').removeClass('disabled');
      }else{
         $('.nexts').addClass('disabled');
      }
      })
       $(".openmodal").on('click',function(){
         $('#id01').removeClass('d-none');
       })
       $(".closemodal").on('click',function(){
         $('#id01').addClass('d-none');
       })
      var modal= document.getElementById("id01");
       window.onclick=function(event){ 
          if(event.target==modal)
         $('#id01').addClass('d-none'); 
       } 
   
      $('#search').on('keyup',function(){
         var val =$(this).val();  
         var URL="{{route('searchmess')}}";   
           $.get({
              url:URL,
              data:{value:val},
              success:function(data){ 
               $(".pu").empty(); 
              $(".pu").prepend(data);  
           }
           }) 
      })
   })
</script>  
@endsection