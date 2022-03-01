@extends('layouts.app') 
@section('content')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick/slick.css') }}"/>
@endpush
   <div class="container">
   <div class="d-block">
      <div class="d-inline-block left border-gray">
         <section>
            <ul class="d-flex story position-relative mySlides">
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
            
               <li>
                  <a>
                     <img src="{{ asset('img/be-giang.png') }}" class="img-story rounded-circle d-inline-block">
                     <div>42  </div>
                  </a>
               </li>
            </ul>
         </section>
         @if(!$count_post)
            @include('layout.homes.no_post')
         @else
         <div class="postss conntent">
             @include('layout.homes.index') 
         </div>
         <div class="auto-load text-center">
               <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                  x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                  <path fill="#000"
                     d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                     <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                           from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                  </path>
               </svg>
         </div>
         @endif  
      </div>
      <div class="d-inline-block right" >
         <div class="d-block">
            <div class="d-inline-block"><a href="{{\Auth::user()->user}}">  
               <img src="{{ pare_url_file(auth()->user()->avatar, 'user') }}" class="rounded-circle w-50">
            </div>
            <div class="d-inline-block">
               <div class="user-link"><a href="{{\Auth::user()->user}}" class="text-black">{{ \Auth::user()->user}}</a></div>
               <div class="user-name" >
                  <p class="os"><a href="{{\Auth::user()->user}}">{{ \Auth::user()->c_name}}</a></p>
               </div>
            </div>
            <br><br>  
            <div class="d-flex">
               <p class="text-gray">{{ __('translate.Suggestions For You')}}</p>
               <a href="" class="text-black fs-12" style="text-align:right;width:68%">{{ __('translate.See All')}}</a>
            </div>
            @foreach($user as $list)
            @if(!\App\Models\Follow::where(['user_id'=>\Auth::id(), 'followed'=>$list->id])->count())
            <div class="d-inline-block position-relative suggest">
               <div class="d-inline-block text-black">
                  <a href="{{ route('get.home-page', $list->user) }}">
                     <img src="{{ pare_url_file($list->avatar, 'user') }}" class="rounded-circle">
                  {{ $list->user}}</a>
               </div>
               <div class="d-inline-block" style="position: absolute; top: 0;right: 0;margin-top: 10px;">
                  <p class="cs follow{{$list->id}}  text-blue" onclick="follow('{{$list->id}}')">{{ ucwords(__('translate.follow'))}}</p>
                  <div class="load{{$list->id}}" style="margin-top:-10px;display:none">
                     <img src="{{ asset('img/loading.gif')}}">
                  </div>
               </div>
            </div>
            @endif
            @endforeach
            <div class="about-us">
               <ul style="line-height:20px;margin-top: 30px;font-size:12px;opacity: 0.5;">
                  <li class="d-inline-block "><a href="{{route('language',['en']) }}">English</a>	&#8226;</li>
                  <li class="d-inline-block "><a href="{{route('language',['vi']) }}">Tiếng Việt</a> &#8226;</li>
                  <li class="d-inline-block "><a href="{{ route('login-activity') }}">{{ __('translate.Locations')}}</a>	&#8226;</li>
               </ul>
               <br>
            </div>
            <p class="text-gray" style="font-size:12px">&copy; 2021 TEAM 8 FROM INFORMATION TECHNOLOGY CLASS</p>
         </div>
      </div>
   </div>
@endsection

@push('js')
<script src="{{ asset('slick/slick/slick.js') }}"></script>
<script src="{{ asset('js/style.js') }}"></script>
@endpush