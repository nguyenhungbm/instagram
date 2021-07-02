<title>{{ $user->c_name}}</title>
@extends('header') 
@section('content')
<body>
<section class="sd">
    @include('layout.avatar',['user' => $user,'height'=>'170px'])
    <div class="csa">
        <div class="csb">
            <span class="os">{{ $user->user }}</span>
            @if($user->user === \Auth::user()->user)
                <a href="{{ route('profile.edit') }}">{{ __('translate.Edit Profile')}}</a>
                <i class="fa fa-2x fa-sun-o" id="myBtn-3"></i>  
                <button id="myBtn-4" class="background-blue button" style="padding: 5px 20px;margin-left: 20px;border-radius: 5px;">Đăng bài</button> 
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
        <div id="myModal-3" class="modal ">
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
            <li><a href="#" id="exit3">{{ __('translate.Cancel')}}</a></li>
            </div>
        </div>

        <div class="csc">
            <p><b style="padding-right: 5px;">{{ count($post)}}</b> {{ __('translate.posts')}}</p>
            <p class="cs" id="myBtn-6"><b style="padding-right: 5px;" class="follower">{{count($userFollow)}}</b>{{ __('translate.followers')}}</p>
            <!-- modal follow -->
            <div id="myModal-6" class="modal">
            <div class="modal-content settings animate__animated animate__zoomIn" >
                <li class="one">{{ ucwords(__('translate.followers'))}} <span class="float-right cs" id="exit6" style="right: 15px;position: absolute;top: 0;">&times;</span></li>
                <div class="settingss">
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
                        <button class="followss zc{{$list->user_id}}" onclick="followInOtherPage('{{$list->user_id}}')" >
                        <cen class="cen{{$list->user_id}}">{{ ucwords(__('translate.folowing'))}}</cen>
                        <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->user_id}}" style="display:none;margin-top: -11px;">
                        @else
                        <button class="followss zc{{$list->user_id}}" onclick="authFollow('{{$list->user_id}}')" >
                        <cen class="cen{{$list->user_id}}">{{ ucwords(__('translate.folowing'))}}</cen>
                        <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->user_id}}" style="display:none;margin-top: -11px;">
                        @endif
                        </button>
                        @else  
                        @if($user->id != \Auth::id())
                        <button class="follows zc{{$list->user_id}}" onclick="followInOtherPage('{{$list->user_id}}')" >
                        <cen class="cen{{$list->user_id}}">{{ __('translate.follow')}}</cen>
                        <img src="{{ asset('img/loading.gif')}}"  style="display:none;"class="w-30 load{{$list->user_id}}">
                        </button>
                        @else
                        <button class="follows zc{{$list->user_id}}" onclick="authFollow('{{$list->user_id}}')" >
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
            <p class="cs" id="myBtn-7">{{ __('translate.folowing')}} <b class="count" style="float: none;">{{ count($areFollow) }}</b>{{ __('translate.following')}}</p>
            <!-- modal setting -->
            <div id="myModal-7" class="modal">
            <div class="modal-content settings animate__animated animate__zoomIn" >
                <li class="one">{{ ucwords(__('translate.followers'))}} <span class="float-right cs" id="exit7" style="right: 15px;position: absolute;top: 0;">&times;</span></li>
                <div class="settingss followed">
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
                        <button class="followss zc{{$list->friends->id}}" onclick="followInOtherPage('{{$list->friends->id}}')" >
                        <cen class="cen{{$list->friends->id}}">{{ __('translate.folowing')}}</cen>
                        <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->friends->id}}" style="display:none;margin-top: -11px;">
                        @else
                        <button class="followss zc{{$list->friends->id}}" onclick="authFollow('{{$list->friends->id}}')" >
                        <cen class="cen{{$list->friends->id}}">{{ __('translate.folowing')}}</cen>
                        <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->friends->id}}" style="display:none;margin-top: -11px;">
                        @endif
                        </button>
                        @else 
                        @if($user->id != \Auth::id()) 
                        <button class="follows zc{{$list->friends->id}}" onclick="followInOtherPage('{{$list->friends->id}}')" >
                        <cen class="cen{{$list->friends->id}}">{{ __('translate.follow')}}</cen>
                        <img src="{{ asset('img/loading.gif')}}"  style="display:none;"class="w-30 load{{$list->friends->id}}">
                        </button>
                        @else
                        <button class="follows zc{{$list->friends->id}}" onclick="authFollow('{{$list->friends->id}}')" >
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
        <b class="name_user">{{ $user->c_name}}</b>  
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
            <img src="{{asset('img/loading.gif')}}"  class="w-30 noss" style="display:none">
            </div>
            <textarea name="p_content" class="textarea p-5" placeholder="Write a caption... (max 2000 charaters)"></textarea>
            
            <!--file-->
            <input type="file" name="profiles" accept="image/*" id="profiles" class='d-none'>
            <!--file-->
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
<div id="myModal-4" class="modal"> 
<div class="modal-content upload animate__animated animate__zoomIn ">
<h4>{{ __('translate.Upload photo')}}</h4>
<div class="button">
<div class="label">
<label for="profiles" class="cs">{{ __('translate.Add to Profile')}}</label>  
<p class="p">{{ __('translate.or')}}</p>
</div>
<div class="label label2">
<label for="stories" class="cs">{{ __('translate.Add to Stories')}}</label>
<input type="file"  name="stories" id="stories"  accept="image/*" class="d-none" readonly> 
</div>
</div>
</div>
</div> 
</form>  
<div class="post-image"> 
    @if(!count($post))
    <div class="clr">
        <br>
        <div class="hea">
            <b>{{ __('translate.Start capturing and sharing your moments.')}}</b>
            <p>{{ __('translate.Get the app to share your first photo or video.')}}</p>
            <br><br>
            <img src="{{ asset('img/appstore.png')}}" class="cs" style="height:40px;width:135px">
            <img src="{{ asset('img/chplay.png')}}" class="cs" style="height:40px;width:135px">
        </div>
    </div>
    <div><img src="{{ asset('img/everything.png')}}" class="float-left hed"></div>
    <br>
    @endif
    <div class="d-grid_image">
        @foreach($post as $key=> $val) 
        <div class="cs cse {{ $key%3 == 1 ? 'uio' : '' }}"  id="myBtnn{{$val->id}}">
            <input type="hidden" value="{{ $val->p_slug}}" id="slug{{$val->id}}">
            <div class="clr csf">
                <i class="fa fa-heart"></i> 
                <p class="likes{{$val->id}}">{{ $val->p_favourite}}</p>
                <i class="fa fa-comment"></i> 
                <p class="comment{{$val->id}}"> {{$val->p_comment }}</p>
            </div>
        @if($key < 61 )
            <img src="{{ pare_url_file($val->p_image,'profile/img_small') }}" class="img_small" id="image{{$key}}">
        @else
            <img data-img="{{ pare_url_file($val->p_image,'profile/img_small') }}" class="lazyload" id="image{{$key}}">
        @endif
        </div>
        <div id="myModall{{$val->id}}" class="modal hei">
            <div class="csg">
            <a href="{{pare_url_file($val->p_image,'profile/img') }}" download class="position-absolute" style="
                left: 15px;top: 15px;z-index: 100;color: white;
                " title="{{$val->p_image}}"> <span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-download fa-stack-1x"></i></span></a>
            <img src="{{ pare_url_file($val->p_image,'profile/img_large') }}" class="csq"> 
            <div class="cle">
                <div class="heq">
                    <div class="hew"><a href="{{ route('get.home-page',$val->user->user)}}"><img src="{{ pare_url_file($val->user->avatar,'user') }}" class="avatar_user_uploaded"></a> </div>
                    <div class="hee">
                        <p><a href="{{ route('get.home-page',$val->user->user)}}"><b>{{$val->user->c_name}} </a></b>
                        @if($val->user->id==$user->id)
                        @else
                            &#8729; <b>{{ __('translate.folowing')}}</b>
                        @endif
                        </p>
                    </div>
                    @include('layout.infomation',['value'=>$val->id])
                </div>
                <div class="her hdl{{$val->id}}" id="hell">
                    @if($val->p_content!='')
                    <div class="clr het">
                        <div class="hew"><a href="{{ route('get.home-page',$val->user->user)}}"><img src="{{ pare_url_file($val->user->avatar,'user') }}" class="avatar_user_uploaded"></a> </div>
                        <div class="hep">
                        <p><a href="{{ route('get.home-page',$val->user->user)}}"><b>{{$val->user->c_name}}</a> </b> {{$val->p_content}}</p>
                        </div>
                        <i class="fa fa-ellipsis-h"></i> 
                        <div class="os heo">{{ $val->created_at->diffForHumans() }} 
                        </div>
                    </div>
                    @endif   
                    <div class="list-comment{{$val->id}}">
                        @foreach(\App\Models\Comment::where('c_post',$val->id)->orderBy('created_at','desc')->get() as $value => $cmt)  
                        <div class="clr het hjk{{$value}} "  style="display:none">
                        <div class="hew"><a href="{{ route('get.home-page',$cmt->users->user)}}"><img src="{{ pare_url_file($cmt->users->avatar,'user') }}" class="{{ $cmt->c_user_id ==\Auth::id() ? 'avatar_user_uploaded' :''}}"></a> </div>
                        <div class="hep">
                            <p><b><a href="{{ route('get.home-page',$cmt->users->user)}}">{{$cmt->users->c_name}}</a> </b> {{$cmt->c_comment}}</p>
                        </div>
                        <i class="fa fa-ellipsis-h"></i>
                        <div class="os heo">{{ $cmt->created_at->diffForHumans() }} </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="buttons"><button class="button{{$val->id}} ">+</button> </div>
                    <script>
                            $('.button{{$val->id}}').on('click',function(){  
                                loadmore(); 
                            }) 
                            currentindex=0;
                            maxindex ="{{\App\Models\Comment::where('c_post',$val->id)->count()}}";
                            function loadmore(){ 
                            x=  window.scrollY;
                            var maxresult = 5;
                            
                            for(var i = 0; i < maxresult; i++)
                            {
                            $(".hjk"+(currentindex+i)).show();
                            }
                            if(currentindex+5>=maxindex){
                            $('.button{{$val->id}}').hide();
                            }
                            window.scrollTo(0,x);
                            currentindex += maxresult;
                            
                            }
                            
                            loadmore();
                    </script>
                </div>
                <div class="hey">
                    @include('layout.attraction_button',['value'=>$val->id])
                    <p class="f-6 "><b class="view{{$val->id}}">{{$val->p_view}}</b> {{ __('translate.views')}}</p>
                    <p class="f-6 " style="margin-top:-6px"> @include('layout.like',['value'=>$val->id])</p>
                    <p class="os">{{ $val->created_at->diffForHumans() }}</p>
                </div>
                    @include('layout.comment',['value'=>$val->id])
            </div>
            </div>
        </div>
<script>   
                //click để scroll đến cuối trang
                // $('body').on('click','#myBtnn{{$val->id}}',function(){
                //    var $div = $("#hell"); 
                //    $div.scrollTop($div[0].scrollHeight);
                // })
                    
                //hiện modal bài viết
                
                
        $(function(){
            $('#myBtnn{{$val->id}}').on('click',function(event){
                if(screen.width >800){
                    $('#myModall{{$val->id}}').show();
                    var post='{{$val->id}}';
                    var URL ="{{ route('post.increview')}}";  
                    $.get({
                        url:URL,
                        data:{post:post},
                        success:function(e){  
                        }
                    })
                }else{
                    var slug =$('#slug{{$val->id}}').val();
                    window.location.href='/p/'+slug;
                }
            })
            $('#myModall{{$val->id}}').on('click',function(event){
                if(event.target == document.getElementById("myModall{{$val->id}}")) 
                    $(this).hide();
            })
        })            
</script>     
@endforeach 
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
<script>
    //lazy load img
    let id="{{count($post)}}";
    console.log(id);
    let options={
        root:null,
        rootMargin:'0px',
        threshold:0.25
    };
    let callback =(entries,observer)=>{
        entries.forEach(entry=>{
            if(entry.isIntersecting && entry.target.className === 'lazyload'){
                let imageUrl = entry.target.getAttribute('data-img');
                if(imageUrl){
                entry.target.src =imageUrl;
                observer.unobserve(entry.target);
                }
            }
        })
    } 
    let observer =new IntersectionObserver(callback,options);
    for( var i=6;i<id;i++) { 
    observer.observe(document.querySelector('#image'+i)); 
    } 
</script>    
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
            $('.noss').show();
        })
    }) 
</script> 
</body>
@endsection

@section('js')
<script src="{{ asset('js/modal.js') }}" ></script> 
<script src="{{ asset('js/post.js') }}" ></script> 
<script src="{{ asset('js/avatar.js') }}" ></script> 
@endsection