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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
        <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
        @stack('css')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-LYEK57L0L5"></script>
        <script src="{{ asset('js/map.js') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            
            gtag('config', 'G-LYEK57L0L5');
        </script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
       
        @laravelPWA
    </head>
<body>
    <div class="loader hidden ">
        <div class="loading-first"></div>
    </div>
    <div id="app">
        @include('layouts.header')
        @yield('content')
    </div>
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
<script src="{{ asset('js/avatar.js') }}" ></script> 
<script src="{{ asset('js/post.js') }}" ></script>
<script src="{{ asset('toastr/toastr.min.js') }}" defer></script>

<script src="{{ asset('js/modal.js') }}" ></script> 
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDSh1SwthGocAh8XZ-kSwnIGnEZJsS_qI&libraries=places&callback=initMap"
      async
    ></script>
@if(session('toastr'))
    <script>    
        var TYPE_MESSAGE="{{session('toastr.type') }}";
        var MESSAGE ="{{session('toastr.messages') }}"; 
    </script>
@endif 
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
@stack('js')
<script src="{{ asset('js/app.js') }}" ></script>
</body>
</html>