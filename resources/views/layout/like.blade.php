@php use App\Models\Like; @endphp
@php use App\Models\Follow; @endphp
<b class="zxm cs" id="buttonLike-{{$value}}">
    @if(Like::where('r_post', $value)->count())
        <b class="like{{$value}}">{{Like::where('r_post', $value)->count()}}</b> {{ __('translate.likes')}}
    @endif
</b>
<!-- modal user image -->
<div id="like-{{$value}}" class="modal">
    <div class="modal-content setting animate__animated animate__zoomIn">
        <li>
            <label style="width:70%">{{ ucwords(__('translate.likes'))}} </label>
            <div class="float-right cs" style="font-size: 30px;padding: 9px 16px;" id="cancel{{$value}}">&times;</div>
        </li>
        <div class="posts{{$value}}">
            @foreach(Like::where('r_post', $value)->get() as $item)
                <div class="clr users{{$item->users->id}}{{$value}}" style="height: 50px;">
                    <a href="{{ route('get.home-page', $item->users->user) }}" class="zx position-relative"
                       style="width:75%">
                        <img src="{{ pare_url_file($item->users->avatar, 'user') }}" class="w-35 rounded-circle">
                        <b class="zz">{{ $item->users->user }}</b><br>
                        <b class="os zpo">{{ $item->users->c_name }}</b>
                    </a>
                    @if($item->users->id!=Auth::id())
                        @if(Follow::checkFollow(Auth::id(), $item->users->id))
                            @if($item->users->id != Auth::id())
                                <button class="followss zc{{$item->users->id}}"
                                        onclick="followInOtherPage('{{$item->users->id}}')">
                                    <span class="cen{{$item->users->id}}">{{ __('translate.folowing')}}</span>
                                    <img src="{{ asset('img/loading.gif')}}" class="w-30 load{{$item->users->id}}"
                                         style="display:none;margin-top: -11px;">
                                    @else
                                        <button class="followss zc{{$item->users->id}}"
                                                onclick="authFollow('{{$item->users->id}}')">
                                            <span class="cen{{$item->users->id}}">{{ __('translate.folowing')}}</span>
                                            <img src="{{ asset('img/loading.gif')}}"
                                                 class="w-30 load{{$item->users->id}}"
                                                 style="display:none;margin-top: -11px;">
                                            @endif
                                        </button>
                                        @else
                                            @if($item->users->id != Auth::id())
                                                <button class="follows zc{{$item->users->id}}"
                                                        onclick="followInOtherPage('{{$item->users->id}}')">
                                                    <span class="cen{{$item->users->id}}">{{ __('translate.follow')}}</span>
                                                    <img src="{{ asset('img/loading.gif')}}" style="display:none;"
                                                         class="w-30 load{{$item->users->id}}">
                                                </button>
                                            @else
                                                <button class="follows zc{{$item->users->id}}"
                                                        onclick="authFollow('{{$item->users->id}}')">
                                                    <span class="cen{{$item->users->id}}">{{ __('translate.follow')}}</span>
                                                    <img src="{{ asset('img/loading.gif')}}" style="display:none;"
                                                         class="w-30 load{{$item->users->id}}">
                                                </button>
                            @endif
                        @endif
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    $('body').on('click', '#buttonLike-{{$value}}', function () {
        $('#like-{{$value}}').show();
    })
    $('body').on('click', '#cancel{{$value}}', function () {
        $('#like-{{$value}}').hide();
    })
    $('body').on('click', '#like-{{$value}}', function (event) {
        if (event.target == document.getElementById('like-{{$value}}'))
            $(this).hide();
    })
</script>