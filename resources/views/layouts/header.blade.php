@php
    $home="img/home-active.png";
    $direct="img/direct.png";
    $explore="img/explore.png"; 
    if(isset($title)) {
        $home="img/home.png";
        if($title=='Khám phá') $explore="img/explore-active.png";
        elseif($title=='Message' ||$title=='Chat') $direct="img/direct-active.png"; 
    }
@endphp
   
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
                <notification v-bind:notifications="notifications"  v-bind:notification_readed="notification_readed"></notification>
                <li class="position-relative set-user">
                    <a> 
                    <img src="{{ pare_url_file(auth()->user()->avatar, 'user') }}" class="mr-20 rounded-circle w-30 avatar_user_uploaded">
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
    <div id="myModal-1" class="modal">
    <div class="modal-content setting animate__animated animate__zoomIn" style="text-align:center">
        <li class="one"><label style="font-size: 20px;">QRCODE</label><span class="float-right cs" id="exit1" style="right: 15px;position: absolute;top: 0;font-size: 33px;">&times;</span></li>
        <img class="img-thumbnails" src="{{ pare_url_file('loadingg.gif', 'qrcode') }}" >
    </div>
</header>