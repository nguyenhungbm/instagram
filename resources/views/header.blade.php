<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="url" content="{{url('/')}}">
        <meta name="theme-color" media="(prefers-color-scheme: light)" content="white">
        <meta name="theme-color" media="(prefers-color-scheme: dark)" content="black">
        <meta name="image" content="{{url('/logo.png')}}">
        <meta name="title" content="Instagram">
        <meta name="description" content="Website kết nối mọi người với nhau , cùng nhau chia sẻ những khoảnh khắc đáng nhớ">
        <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : 'null' }}">
        <title>{{ __('translate.'.$title) ?? 'Instagram'}}</title>
        <link rel="stylesheet" href="{{ asset('css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/direct.css') }}">
        <link rel="stylesheet" href="{{ asset('css/reponsive.css') }}">
        <link rel="stylesheet" href="{{ asset('css/explore.css') }}">
        <link rel="stylesheet" href="{{ asset('css/home-page.css') }}">
        <link rel="stylesheet" href="{{ asset('fontawesome/css/font-awesome.min.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
        <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-LYEK57L0L5"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            
            gtag('config', 'G-LYEK57L0L5');
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        @if(session('toastr'))
        <script>    
            var TYPE_MESSAGE="{{session('toastr.type') }}";
            var MESSAGE ="{{session('toastr.messages') }}"; 
        </script>
        @endif 
        @laravelPWA
    </head>
    @php
    $home="img/home.png";
    $direct="img/direct.png";
    $explore="img/explore.png"; 
    if($title=='Khám phá') $explore="img/explore-active.png";
    elseif($title=='Message' ||$title=='Chat') $direct="img/direct-active.png"; 
    else  $home="img/home-active.png";
    @endphp
    <div class="loader hidden ">
        <div class="loading-first"></div>
    </div>
    <div id="app">
        <header>
            <div class="container">
                <div style="display: flex;justify-content:space-between;">
                    <a href="{{ url('/')}}"><img src="{{ asset('img/logo.png') }}"  width="103px" height="29px"></a>
                    @include('layout.header.search')
                    <ul  class="d-flex">
                        <li>
                            <a href="/">
                            <img class="mr-20 rounded-circle w-30" src="{{ asset($home) }}" >
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/direct') }}">
                            <img class="mr-20 rounded-circle w-30" src="{{ asset($direct) }}" >
                            </a>
                        </li>
                        <!-- <li class=" position-relative">
                            <a href="{{ url('/explore') }}">
                            <img class="mr-20 rounded-circle w-30" src="{{ asset($explore)  }}" >
                            </a>  
                            </li> -->
                        <notification v-bind:notifications="notifications"  v-bind:notification_readed="notification_readed"></notification>
                        <li class="position-relative set-user">
                            <a> 
                            <img src="{{ pare_url_file(auth()->user()->avatar,'user') }}" class="mr-20 rounded-circle w-30 avatar_user_uploaded">
                            </a>
                            <ul class="notification set-user-width d-none">
                                <li>
                                    <a href="{{ route('get.home-page',auth()->user()->user) }}">
                                    <i class="fa fa-user-circle"></i>
                                    <span>{{ __('translate.Profile')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" id="myBtn-1"><i class="fa fa-lg fa-qrcode"></i> 
                                    <span>{{ __('translate.Create QR Login')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('profile.edit') }}">
                                    <i class="fa fa-lg fa-sun-o"></i>
                                    <span>{{ __('translate.Settings')}}</span>
                                    </a>
                                </li>
                                <li>
                                    <hr>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" onclick="event.preventDefault(); $('.logout-form').submit();">
                                    {{ __('translate.Log Out')}}
                                    </a>
                                </li>
                                <form class="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <script>
            $(function(){
                $('.noti').on('click',function(){
                    $('.set-noti-width').toggleClass("d-none");
                    $('.set-user-width').addClass("d-none");
                })
                $('.set-user').on('click',function(){
                    $('.set-noti-width').addClass("d-none");
                    $('.set-user-width').toggleClass("d-none");
                }) 
            })
            
        </script>
        @yield('content')
    </div>
    <div id="myModal-1" class="modal">
    <div class="modal-content setting animate__animated animate__zoomIn" style="text-align:center">
        <li class="one"><label style="font-size: 20px;">QRCODE</label><span class="float-right cs" id="exit1" style="right: 15px;position: absolute;top: 0;font-size: 33px;">&times;</span></li>
        <img class="img-thumbnails" src="{{ pare_url_file('qrcode.svg','qrcode') }}" >
    </div>
</div>
</html>
@stack('js')
<script src="{{ asset('js/modal.js') }}" ></script> 
<script>
      $(function(){
    $('body').on('click','#myBtn-1',function(){
        $('#myModal-1').show();
        var url ="{{route('qrcode.login')}}";
        $.get({
            url:url,
            success:function(e){
                $('.img-thumbnails').attr('src',e.img); 
            }
        })
    })
    $('body').on('click','#exit1',function(){
        $('#myModal-1').hide();
    })
    $('#myModal-1').on('click',function(event){
        if(event.target == document.getElementById("myModal-1")) 
            $(this).hide()
    })
    })
</script>
<script src="{{ asset('js/app.js') }}" ></script>
<script src="{{ asset('toastr/toastr.min.js') }}" defer></script>

<script>
    if(typeof TYPE_MESSAGE != "undefined"){
        switch (TYPE_MESSAGE){
            case 'success':
                toastr.success(MESSAGE)
                break;
            case 'error':
                toastr.error(MESSAGE)
                break;
        }
    }
  
</script>