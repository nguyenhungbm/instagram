<div class="position-relative cs user" style="height:{{$height}};width:{{$height}};margin-left: 20px">
   <img src="{{ pare_url_file($user->avatar,'user') }}" class="rounded-circle avatar_user_uploaded " id="{{$user->id == \Auth::id() ? 'myBtn-5' : ''}}"  style="height:{{$height}};width:{{$height}}">
   <img src="{{ asset('img/loading.gif')}}" class="imguser" style="display:none">
</div>
 