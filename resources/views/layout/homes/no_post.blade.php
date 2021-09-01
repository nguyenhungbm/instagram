<div class="d-block text-center cs" id="myBtn-2">
   <i class="fa fa-lg fa-plus-square-o" style="font-size:400%"></i>
   <p>{{ __('translate.Start following other people to share memories')}}</p>
</div>
<!-- modal user image -->
<div class="suggest-follow">
   <div id="myModal-2" class="modal">
      <div class="modal-content setting animate__animated animate__zoomIn" >
         <li >
            <label style="width:70%">{{ __('translate.Suggestions For You')}}</label> 
            <div class="float-right cs" style="font-size: 30px;padding: 9px 16px;" id="exit5">&times;</div>
         </li>
      @foreach($user as $list)
      @if(!\App\Models\Follow::where(['user_id'=>\Auth::id(),'followed'=>$list->id])->count())
         <div class="d-inline-block position-relative suggest" >
            <div class="d-inline-block text-black">
               <a href="{{ route('get.home-page',$list->user) }}"><img src="{{ pare_url_file($list->avatar,'user') }}" class="rounded-circle">
                           {{ $list->user}}
               </a>
            </div>
            <div class="d-inline-block float-right" style="padding:10px">
               <p class="cs follow{{$list->id}}  text-blue" onclick="follow('{{$list->id}}')">{{ ucwords(__('translate.follow'))}}</p>
               <div class="load{{$list->id}}" style="margin-top:-10px;display:none">
                  <img src="{{ asset('img/loading.gif')}}">
               </div>
            </div>
         </div>
      @endif
      @endforeach
      </div>
   </div>
</div>