<div class="position-relative cs user" style="height:{{$height}};width:{{$height}};margin-left: 20px">
    <img src="{{ pare_url_file($user->avatar, 'user') }}" class="rounded-circle avatar_user_uploaded "
         id="{{$user->id == Auth::id() ? 'myBtn-5' : ''}}" style="height:{{$height}};width:{{$height}}">
    <img src="{{ asset('img/loading.gif')}}" class="imguser" style="display:none">
</div>
<form method="POST" enctype="multipart/form-data" id="form_upload_user_avatar">
    @csrf
    <input type="file" onchange="uploadUserAvatar(this, 'form_upload_user_avatar')" accept="image/*"
           name="upload_user_avatar" class="d-none" id="upload_user_avatar">
</form>
<!-- modal user image -->
<div id="myModal-5" class="modal">
    <div class="modal-content setting animate__animated animate__zoomIn">
        <li class="hed"><a href="javascript:">{{ __('translate.Change Profile Photo')}}</a></li>
        <li>
            <label for="change_user" class="text-blue change cs">{{ __('translate.Upload Photo')}}</label>
            <form method="POST" enctype="multipart/form-data" id="form_change_user_avatar">
                @csrf
                <input type="file" onchange="uploadUserAvatar(this, 'form_change_user_avatar')" accept="image/*"
                       name="upload_user_avatar" class="d-none" id="change_user">
            </form>
        </li>
        <li><a href="javascript:" class="text-red remove_current_photo">{{ __('translate.Remove Current Photo')}}</a>
        </li>
        <li class="cs" id="exit5"><a href="javascript:">{{ __('translate.Cancel')}}</a></li>
    </div>
</div>