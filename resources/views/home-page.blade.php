<title>{{ $user->c_name}}</title>
<style>
@media only screen and (max-width: 670px) {
    #myBtn-5 {
        width: 100px !important;
        height: 100px !important;
        margin-left: 0;
        margin-top: 10px;
    }
}

.followss span{
    font-size: 13px !important;
}
</style>
@extends('layouts.app')
@section('content')
<section class="sd">
    @include('layout.avatar',['user' => $user,'height'=>'170px'])
    <div class="csa">
        <div class="csb">
            <span class="os">{{ $user->user }}</span>
            @if($user->user === \Auth::user()->user)
            <a href="{{ route('profile.edit') }}">{{ __('translate.Edit Profile')}}</a>
            <i class="fa fa-2x fa-sun-o" id="myBtn-3"></i>
            <button id="myBtn-4" class="background-blue button"
                style="padding: 5px 20px;margin-left: 20px;border-radius: 5px;">Đăng bài</button>
            @else
            <div class="list-follow">
                @if(!$followed)
                <button class="follow" onclick="follow('{{$user->id}}')">
                    <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$user->id}}" style="display:none">
                    <p class="text-follows{{$user->id}}">{{ __('translate.follow')}}</p>
                </button>
                @else
                <a href="{{ route('chat.show', $user->id) }}" class="message">{{ __('translate.Message')}}</a>
                <a class="unfollow follows{{$user->id}}" href="javascript:;" onclick="follow('{{$user->id}}')">
                    <i class="fa  fa-user-times"></i>
                    <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$user->id}}"
                        style="display:none;margin-top: -11px;">
                </a>
                @endif
            </div>
            @endif
        </div>
        <!-- modal setting -->
        <div id="myModal-3" class="modal ">
            <div class="modal-content setting animate__animated animate__zoomIn">
                <li><a href="{{route('password.edit')}}">{{ __('translate.Change Password')}}</a></li>
                <li><a href="">{{ __('translate.Nametag')}}</a></li>
                <li><a href="">{{ __('translate.Apps and Websites')}}</a></li>
                <li><a href="">{{ __('translate.Notifications')}}</a></li>
                <li><a href="">{{ __('translate.Privacy and Security')}}</a></li>
                <li><a href="{{ route('login-activity') }}">{{ __('translate.Login Activity')}}</a></li>
                <li><a href="">{{ __('translate.Emails from Instagram')}}</a></li>
                <li><a href="">{{ __('translate.Report a Problem')}}</a></li>
                <li><a href="javascript:void(0)" onclick="event.preventDefault(); $('.logout-form').submit();">
                        {{ __('translate.Log Out')}}
                    </a></li>
                <li><a href="#" id="exit3">{{ __('translate.Cancel')}}</a></li>
            </div>
        </div>
        <div class="csc">
            <p><b>{{Auth::user()->picture}}</b> {{ __('translate.posts')}}</p>
            <p class="cs" id="myBtn-6"><b class="follower">{{count($userFollow)}}</b> {{ __('translate.followers')}}</p>
            <!-- modal follow -->
            <div id="myModal-6" class="modal">
                <div class="modal-content settings animate__animated animate__zoomIn">
                    <li class="one">{{ ucwords(__('translate.followers'))}} <span class="float-right cs" id="exit6"
                            style="right: 15px;position: absolute;top: 0;">&times;</span></li>
                    <div class="settingss">
                        @if(!count($userFollow))
                        <li class="k-none"><i class="fa fa-lg fa-user-plus"></i></li>
                        <li class="k-none two">{{ ucwords(__('translate.followers'))}}</li>
                        <li class="k-none three">{{ __("translate.You'll see all the people who follow you here.")}}
                        </li>
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
                            <button class="followss zc{{$list->user_id}}"
                                onclick="followInOtherPage('{{$list->user_id}}')">
                                <span class="fs-13 cen{{$list->user_id}}">{{ ucwords(__('translate.folowing'))}}</span>
                                <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->user_id}}"
                                    style="display:none;margin-top: -11px;">
                                @else
                                <button class="followss zc{{$list->user_id}}"
                                    onclick="authFollow('{{$list->user_id}}')">
                                    <span
                                        class="fs-13 cen{{$list->user_id}}">{{ ucwords(__('translate.folowing'))}}</span>
                                    <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->user_id}}"
                                        style="display:none;margin-top: -11px;">
                                    @endif
                                </button>
                                @else
                                @if($user->id != \Auth::id())
                                <button class="follows zc{{$list->user_id}}"
                                    onclick="followInOtherPage('{{$list->user_id}}')">
                                    <span class="fs-13 cen{{$list->user_id}}">{{ __('translate.follow')}}</span>
                                    <img src="{{ asset('img/loading.gif')}}" style="display:none;"
                                        class="w-30 load{{$list->user_id}}">
                                </button>
                                @else
                                <button class="follows zc{{$list->user_id}}" onclick="authFollow('{{$list->user_id}}')">
                                    <span class="fs-13 cen{{$list->user_id}}">{{ __('translate.follow')}}</span>
                                    <img src="{{ asset('img/loading.gif')}}" style="display:none;"
                                        class="w-30 load{{$list->user_id}}">
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
            <p class="cs" id="myBtn-7">{{ __('translate.folowing')}} <b
                    class="count">{{ count($areFollow) }}</b>{{ __('translate.following')}}</p>
            <!-- modal setting -->
            <div id="myModal-7" class="modal">
                <div class="modal-content settings animate__animated animate__zoomIn">
                    <li class="one">{{ ucwords(__('translate.followers'))}} <span class="float-right cs" id="exit7"
                            style="right: 15px;position: absolute;top: 0;">&times;</span></li>
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
                                <img src="{{ pare_url_file($list->friends->avatar,'user') }}"
                                    class="w-35 rounded-circle">
                                <b class="zz">{{ $list->friends->user }}</b><br>
                                <b class="os zpo">{{ $list->friends->c_name }}</b>
                            </a>
                            @if($list->friends->id!=\Auth::id())
                            @if(\App\Models\Follow::checkFollow(\Auth::id(),$list->friends->id))
                            @if($user->id != \Auth::id())
                            <button class="followss zc{{$list->friends->id}}"
                                onclick="followInOtherPage('{{$list->friends->id}}')">
                                <span class="fs-13 cen{{$list->friends->id}}">{{ __('translate.folowing')}}</span>
                                <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->friends->id}}"
                                    style="display:none;margin-top: -11px;">
                                @else
                                <button class="followss zc{{$list->friends->id}}"
                                    onclick="authFollow('{{$list->friends->id}}')">
                                    <span class="fs-13 cen{{$list->friends->id}}">{{ __('translate.folowing')}}</span>
                                    <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$list->friends->id}}"
                                        style="display:none;margin-top: -11px;">
                                    @endif
                                </button>
                                @else
                                @if($user->id != \Auth::id())
                                <button class="follows zc{{$list->friends->id}}"
                                    onclick="followInOtherPage('{{$list->friends->id}}')">
                                    <span class="fs-13 cen{{$list->friends->id}}">{{ __('translate.follow')}}</span>
                                    <img src="{{ asset('img/loading.gif')}}" style="display:none;"
                                        class="w-30 load{{$list->friends->id}}">
                                </button>
                                @else
                                <button class="follows zc{{$list->friends->id}}"
                                    onclick="authFollow('{{$list->friends->id}}')">
                                    <span class="fs-13 cen{{$list->friends->id}}">{{ __('translate.follow')}}</span>
                                    <img src="{{ asset('img/loading.gif')}}" style="display:none;"
                                        class="w-30 load{{$list->friends->id}}">
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
        <b class="name">{{ $user->c_name}}</b>
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
                <img src="{{asset('img/loading.gif')}}" class="w-30 noss" style="display:none">
            </div>
            <textarea name="p_content" class="textarea p-5"
                placeholder="Write a caption... (max 2000 charaters)"></textarea>
            <!--file-->
            <input type="file" name="profiles" accept="image/*" id="profiles" class='d-none'>
            <!--file-->
    </div>
    <img id="image-post" src="{{ asset('img/heart-outline.png') }}">
</div>
<div class="posts">
    <div class="csd">
        <button class="bt" id="first" style="text-transform: uppercase;"><i class="fa fa-table"></i>
            {{ __('translate.posts')}}</button>
        <button id="second"><i class="fa fa-television"></i> IGTV</button>
        <button id="third" style="text-transform: uppercase;"><i class="fa  fa-arrows-alt"></i>
            {{ __('translate.saved')}}</button>
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
                    <input type="file" name="stories" id="stories" accept="image/*" class="d-none" readonly>
                </div>
            </div>
        </div>
    </div>
    </form>
    @if(!count($post))
    @include('layout.homepage.no_post')
    @else
    <div class="clr homepage">
        @include('layout.homepage.index')
    </div>
    <div class="auto-load text-center">
        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
            y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
            <path fill="#000"
                d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
                    to="360 50 50" repeatCount="indefinite" />
            </path>
        </svg>
    </div>
    @endif

    <div class="d-none post-video">
        @if(!count($video))
        <div class="hef">
            <span class="fa-stack fa-2x fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i
                    class="fa fa-video-camera fa-stack-1x"></i></span>
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
    <p class="os" style="text-align:center">&copy; 2020 INSTAGRAM FROM FACEBOOK</p>
    <br>
    <script>
    $(function() {
        $('#first').on('click', function(e) {
            e.preventDefault();
            $('.post-image').removeClass('d-none');
            $('.post-video').addClass('d-none');


            $(this).addClass('bt');
            $('#second').removeClass('bt');
        })
        $('#second').on('click', function(e) {
            e.preventDefault();
            $('.post-image').addClass('d-none');
            $('.post-video').removeClass('d-none');

            $(this).addClass('bt');
            $('#first').removeClass('bt');
        })
        $('.next').on('click', function() {
            $('.first').addClass('d-none');
            $('.second').removeClass('d-none');
        })
        $('.back').on('click', function() {
            $('.first').removeClass('d-none');
            $('.second').addClass('d-none');
        })
        $('.image b').css("cursor", "pointer");
        $('.image b').on('click', function() {
            $('.image').addClass('d-none');
        })
        $('.submit').on('click', function() {
            $(this).hide();
            $('.noss').show();
        })
    })
    </script>
    @endsection