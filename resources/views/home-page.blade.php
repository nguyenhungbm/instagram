<title>{{ $user->c_name}}</title>
@include('header')
<body>
   <script>
      $(function(){ 
      //số bài viết
      $({ post_count: 0 }).animate({
      post_count: {{ $countPost}}
         }, {
      duration: 1000,
      easing: 'swing',
      step: function() {
         $('.post_count').text(Math.ceil(this.post_count));
         }
      });  
      //số người mình đang theo dõi
      $({ follower: 0 }).animate({
      follower: {{count($userFollow)}}
         }, {
      duration: 1000,
      easing: 'swing',
      step: function() {
         $('.follower').text(Math.ceil(this.follower));
         }
      });
      //số người đang theo dõi mình
      $({ count: 0 }).animate({
      count:{{ count($areFollow) }}
         }, {
      duration: 1000,
      easing: 'swing',
      step: function() {
         $('.count').text(Math.ceil(this.count));
         }
      });
      })
   </script> 
   <section class="sd">
      <img src="{{ pare_url_file($user->avatar,'user') }}" class="rounded-circle user cs avatar_user_uploaded" id="{{$user->id == \Auth::id() ? 'myBtn-5' : ''}}">
      <img src="{{ asset('img/loading.gif')}}" class=" uploadavatar imguser" style="display:none;">
      </div>
      <form method="POST" enctype="multipart/form-data" id="form_upload_user_avatar">
         @csrf
         <input type="file" onchange="uploadUserAvatar(this,'form_upload_user_avatar')" accept="image/*"  name="upload_user_avatar" class="d-none" id="upload_user_avatar">
      </form>
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
      <div class="csa">
         <div class="csb">
            <span class="os">{{ $user->user }}</span>
            @if($user->user === \Auth::user()->user)
            <a href="{{ route('profile.edit') }}">{{ __('translate.Edit Profile')}}</a>
            <i class="fa fa-2x fa-sun-o" id="myBtn-2"></i> 
            <span class="fa-stack fa-lg cs" id="myBtn"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-plus fa-stack-1x"></i></span> 
            @else  
            <div class="list-follow">
               @if(!$followed)
               <button class="follow" onclick="follow('{{$user->id}}')">
                  <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$user->id}}" style="display:none">
                  <p class="text-follows{{$user->id}}">{{ __('translate.follow')}}</p>
               </button>
               @else
               <a href="{{ route('chat.show', $user->id) }}" class="message">{{ __('translate.Message')}}</a>
               <a class="unfollow follows{{$user->id}}"href="javascript:;"  onclick="follow('{{$user->id}}')">
               <i class="fa  fa-user-times"></i>
               <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$user->id}}" style="display:none;margin-top: -11px;">
               </a>
               @endif
            </div>
            @endif
         </div>
         <!-- modal setting -->
         <div id="myModal-2" class="modal ">
            <div class="modal-content setting animate__animated animate__zoomIn" >
               <li><a href="{{route('password.edit')}}">{{ __('translate.Change Password')}}</a></li>
               <li><a href="">{{ __('translate.Nametag')}}</a></li>
               <li><a href="">{{ __('translate.Apps and Websites')}}</a></li>
               <li><a href="">{{ __('translate.Notifications')}}</a></li>
               <li><a href="">{{ __('translate.Privacy and Security')}}</a></li>
               <li><a href="">{{ __('translate.Login Activity')}}</a></li>
               <li><a href="">{{ __('translate.Emails from Instagram')}}</a></li>
               <li><a href="">{{ __('translate.Report a Problem')}}</a></li>
               <li><a href="{{ route('get.logout') }}">{{ __('translate.Log Out')}}</a></li>
               <li><a href="#" id="exit">{{ __('translate.Cancel')}}</a></li>
            </div>
         </div>
         <div class="csc">
            <p><b style="padding-right: 5px;" class="post_count">0</b> {{ __('translate.posts')}}</p>
            <p class="cs" id="myBtn-6"><b style="padding-right: 5px;" class="follower">0</b>{{ __('translate.followers')}}</p>
            <!-- modal setting -->
            <div id="myModal-6" class="modal">
               <div class="modal-content settings animate__animated animate__zoomIn" >
                  <li class="one">{{ ucwords(__('translate.followers'))}} <span class="float-right cs" id="exit6" style="margin-top:-8px">&times;</span></li>
                  <div class="list">
                     @if(!count($userFollow)) 
                     <li class="k-none"><i class="fa fa-lg fa-user-plus"></i></li>
                     <li class="k-none two">{{ ucwords(__('translate.followers'))}}</li>
                     <li class="k-none three">{{ __("translate.You'll see all the people who follow you here.")}}</li>
                     @else
                     <!-- số người theo dõi mình -->
                     @foreach($userFollow as $list)  
                     <li class="clr user{{$list->user_id}}" style="height: 50px;">
                        <a href="{{ $list->users->user }}" class="zx position-relative ">
                        <img src="{{ pare_url_file($list->users->avatar,'user') }}" class="w-35 rounded-circle"> 
                        <b class="zz">{{ $list->users->user }}</b><br>
                        <b class="os zpo">{{ $list->users->c_name }}</b>
                        </a>
                        @if($list->user_id!=\Auth::id())
                        @if(\App\Models\Follow::checkFollow(\Auth::id(),$list->user_id))
                        @if($user->id != \Auth::id())
                        <button class="followss zc{{$list->user_id}}" onclick="follows('{{$list->user_id}}')" >
                           <cen class="cen{{$list->user_id}}">{{ ucwords(__('translate.folowing'))}}</cen>
                           <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->user_id}}" style="display:none;margin-top: -11px;">
                           @else
                        <button class="followss zc{{$list->user_id}}" onclick="followss('{{$list->user_id}}')" >
                           <cen class="cen{{$list->user_id}}">{{ ucwords(__('translate.folowing'))}}</cen>
                           <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->user_id}}" style="display:none;margin-top: -11px;">
                           @endif
                        </button>
                        @else  
                        @if($user->id != \Auth::id())
                        <button class="follows zc{{$list->user_id}}" onclick="follows('{{$list->user_id}}')" >
                           <cen class="cen{{$list->user_id}}">{{ __('translate.follow')}}</cen>
                           <img src="{{ asset('img/loading.gif')}}"  style="display:none;"class="w-30 load{{$list->user_id}}">
                        </button>
                        @else
                        <button class="follows zc{{$list->user_id}}" onclick="followss('{{$list->user_id}}')" >
                           <cen class="cen{{$list->user_id}}">{{ __('translate.follow')}}</cen>
                           <img src="{{ asset('img/loading.gif')}}"  style="display:none;"class="w-30 load{{$list->user_id}}">
                        </button>
                        @endif
                        @endif
                        @endif
                     </li>
                     @endforeach
                     @endif
                  </div>
               </div>
            </div>
            <!--end modal-->
            <p class="cs" id="myBtn-7">{{ __('translate.folowing')}} <b class="count" style="float: none;">0</b>{{ __('translate.following')}}</p>
            <!-- modal setting -->
            <div id="myModal-7" class="modal">
               <div class="modal-content settings animate__animated animate__zoomIn" >
                  <li class="one">{{ ucwords(__('translate.followers'))}} <span class="float-right cs" id="exit7" style="margin-top:-8px">&times;</span></li>
                  <div class="list">
                     @if(!count($areFollow))
                     <li><i class="fa fa-lg fa-user-plus"></i></li>
                     <li class="two">{{ ucwords(__('translate.folowing'))}}</li>
                     <li class="three">{{ __("translate.You'll see all the people who follow you here.")}}</li>
                     @else
                     <!-- đang theo dõi -->
                     @foreach($areFollow as $key=> $list)   
                     <li class="clr users{{$list->friends->id}}" style="height: 50px;">
                        <a href="{{ $list->friends->user }}" class="zx position-relative">
                        <img src="{{ pare_url_file($list->friends->avatar,'user') }}" class="w-35 rounded-circle"> 
                        <b class="zz">{{ $list->friends->user }}</b><br>
                        <b class="os zpo">{{ $list->friends->c_name }}</b>
                        </a>
                        @if($list->friends->id!=\Auth::id()) 
                        @if(\App\Models\Follow::checkFollow(\Auth::id(),$list->friends->id))
                        @if($user->id != \Auth::id())
                        <button class="followss zc{{$list->friends->id}}" onclick="follows('{{$list->friends->id}}')" >
                           <cen class="cen{{$list->friends->id}}">{{ __('translate.folowing')}}</cen>
                           <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->friends->id}}" style="display:none;margin-top: -11px;">
                           @else
                        <button class="followss zc{{$list->friends->id}}" onclick="followss('{{$list->friends->id}}')" >
                           <cen class="cen{{$list->friends->id}}">{{ __('translate.folowing')}}</cen>
                           <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->friends->id}}" style="display:none;margin-top: -11px;">
                           @endif
                        </button>
                        @else 
                        @if($user->id != \Auth::id()) 
                        <button class="follows zc{{$list->friends->id}}" onclick="follows('{{$list->friends->id}}')" >
                           <cen class="cen{{$list->friends->id}}">{{ __('translate.follow')}}</cen>
                           <img src="{{ asset('img/loading.gif')}}"  style="display:none;"class="w-30 load{{$list->friends->id}}">
                        </button>
                        @else
                        <button class="follows zc{{$list->friends->id}}" onclick="followss('{{$list->friends->id}}')" >
                           <cen class="cen{{$list->friends->id}}">{{ __('translate.follow')}}</cen>
                           <img src="{{ asset('img/loading.gif')}}"  style="display:none;"class="w-30 load{{$list->friends->id}}">
                        </button>
                        @endif
                        @endif
                        @endif
                     </li>
                     @endforeach
                     @endif
                  </div>
               </div>
            </div>
            <!--end modal-->
         </div>
         <b>{{ $user->c_name}}</b>  
      </div>
   </section>
   <div class="image d-none">
      <div class="title first">
         <b>{{ __('translate.Cancel')}}</b>
         <p>{{ __('translate.New Post')}}</p>
         <a href="javascript:;" class="next">{{ __('translate.Next')}} <i class="fa fa-long-arrow-right"></i></a>
      </div>
      <div class="second d-none">
         <form action="{{ route('post.profile')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title ">
               <a href="javascript:;" class="back"><i class="fa fa-long-arrow-left"></i> {{ __('translate.Back')}} </a>
               <p>{{ __('translate.New Post')}}</p>
               <button type="submit" class="submit">{{ __('translate.Share')}}</button> 
               <img src="{{asset('img/loading.gif')}}"  class="w-30 nos" style="display:none">
            </div>
            <textarea name="p_content" class="textarea p-5" placeholder="Write a caption... (max 2000 charaters)"></textarea>
      </div>
      <img id="image-post" src="{{ asset('img/heart-outline.png') }}" >
   </div>
   <div class="posts">
   <div class="csd">
   <button  class="bt" id="first"  style="text-transform: uppercase;"><i class="fa fa-table"></i> {{ __('translate.posts')}}</button>
   <button id="second"><i class="fa fa-television"></i> IGTV</button>
   <button id="third"  style="text-transform: uppercase;"><i class="fa  fa-arrows-alt"></i> {{ __('translate.saved')}}</button>
   <button id="fourst"><i class="fa fa-user"></i> {{ __('translate.TAGGED')}}</button> 
   </div> 
   <!-- modal upload profile and story -->
   <div id="myModal" class="modal"> 
   <div class="modal-content upload animate__animated animate__zoomIn ">
   <h4>{{ __('translate.Upload photo')}}</h4>
   <div class="button">
   <div class="label">
   <label for="profiles" class="cs">{{ __('translate.Add to Profile')}}</label>  
   <!--file-->
   <input type="file" name="profiles" accept="image/*" id="profiles" class='d-none'>
   <!--file-->
   <p class="p">{{ __('translate.or')}}</p>
   </div>
   <div class="label label2">
   <label for="stories" class="cs">{{ __('translate.Add to Stories')}}</label>
   <input type="file"  name="stories" id="stories"  accept="image/*" class="d-none"> 
   </div>
   </div>
   </div>
   </div> 
   </form>  
   <div class="post-image">
      @include('layout.HomePage.index',['user_id'=>$user->id,'user'=>$user->user])
      <div class="clr">
      
      </div>
   </div>
   <div class="d-none post-video">
      @if(!count($video))
      <div class="hef">
         <span class="fa-stack fa-2x fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-video-camera fa-stack-1x"></i></span>
         <p>{{ __('translate.Upload a Video') }}</p>
         <p>{{ __('translate.Videos must be between 1 and 60 minutes long.') }}</p>
         <a href="{{ route('upload.video')}}">{{ __('translate.Upload') }}</a>
      </div>
      @endif
   </div>
   <footer>
      <ul>
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
</body>
<p class="os" style="text-align:center">&copy; 2020 INSTAGRAM FROM FACEBOOK</p>
<br>
<script src="{{ asset('js/modal.js') }}"></script> 
<script src="{{ asset('js/post.js') }}"></script> 
<script src="{{ asset('js/avatar.js') }}"></script> 

<script>
   $(function(){  
   $('#first').on('click',function(e){
      e.preventDefault();
      $('.post-image').removeClass('d-none');
      $('.post-video').addClass('d-none');
   
      
      $(this).addClass('bt');
      $('#second').removeClass('bt');
   })
   $('#second').on('click',function(e){
      e.preventDefault();
      $('.post-image').addClass('d-none');
      $('.post-video').removeClass('d-none');
      
      $(this).addClass('bt');
      $('#first').removeClass('bt');
   }) 
      $('.next').on('click',function(){
            $('.first').addClass('d-none');
            $('.second').removeClass('d-none');
       })
       $('.back').on('click',function(){
            $('.first').removeClass('d-none');
            $('.second').addClass('d-none');
       })
      $('.image b').css("cursor","pointer");
            $('.image b').on('click',function(){
            $('.image').addClass('d-none');
       })
       $('.submit').on('click',function(){
         $(this).hide();
         $('.nos').show();
      })
  
   }) 
</script> 
</body>
</html>