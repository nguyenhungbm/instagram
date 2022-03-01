@if(isset($val))
@foreach($val as $key=> $list)
<li class="clr">
    <a href="{{ route('get.home-page', $list->user) }}">
        <div class="s-img">
            <img src="{{ pare_url_file($list->avatar, 'user') }}" class="w-35 rounded-circle"> 
        </div>
        <div>
            <b>{{ $list->user}}</b><br>
            <p>{{ $list->c_name}}</p>
        </div>
    </a>
</li>
@endforeach
@endif 