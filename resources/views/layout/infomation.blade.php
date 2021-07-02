 
<i class="fa fa-ellipsis-h" id="Btn{{$value}}"></i>
<!-- modal infomation -->
<div id="Modal{{$value}}" class="modal">
    <div class="modal-content setting animate__animated animate__zoomIn" >
        @if($val->user->id != \Auth::id())
        <!-- <li><label class="text-red">{{ __('translate.Report')}}</label></li> -->
        @endif
        <li><a href="{{route('post.view',$val->p_slug)}}" >{{ __('translate.Go to post')}}</a> </li>
        <li class="cs qrcode" id="Btn2{{$value}}"><label >QR CODE</label></li>
        <!-- <li class="cs" id="Btn1{{$value}}"><label >{{ __('translate.Share to')}} ...</label></li> -->
        <input type="text" value="{{route('post.view',$val->p_slug)}}" id="myInput{{$value}}" style="opacity:0;position:absolute">
        <li class="tooltip">
            <a onclick="myFunction()" onmouseout="outFunc()">
            <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
            {{ __('translate.Copy Link')}}
            </a>
        </li>
        <li class="cs" id="exits{{$value}}"><label >{{ __('translate.Cancel')}}</label></li>
    </div>
</div>
<!-- copy link -->
<script>
    function myFunction() {
        var copyText = document.getElementById("myInput{{$value}}");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copied";
    }
   
    function outFunc() {
        var tooltip = document.getElementById("myTooltip");
        tooltip.innerHTML = "Copy to clipboard";
    }
</script>
<!-- modal share -->
<div id="Modal1{{$value}}" class="modal">
<div class="modal-content setting animate__animated animate__zoomIn" >
    <li><label class="text-red">{{ __('translate.Share to')}}</label></li>
    <li> 
        <div data-href="{{route('post.view',$val->p_slug)}}"  >
            <!-- <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fa fa-facebook" style="margin-top:0;margin-right:5px"></i>{{ __('translate.Share to')}} Facebook</a> -->
            <a href="javascript:;">{{ __('translate.Share to')}} Facebook</a>
        </div>
    </li>
    <li>
    <!-- <a class="twitter-sh are-button" href="https://twitter.com/intent/tweet"> <i class="fa fa-twitter" 
    style="margin-top:0"></i> {{ __('translate.Share to')}} Twitter</a>  -->
    <a href="javascript:;">{{ __('translate.Share to')}} Twitter</a>

    </li>
    <li> 
        <!-- <label class="zalo-share-button" data-href="{{ route('post.view',$val->p_slug) }}" data-layout="1" data-oaid="579745863508352884"  data-color="blue" data-customize=false></label> -->
        <a href="javascript:;">{{ __('translate.Share to')}} Zalo</a>

    </li>
    <li class="cs" id="exits1{{$value}}"><label>{{ __('translate.Cancel')}}</label></li>
    </div>
</div> 
 <!-- modal -->
 
<!-- modal qr -->
<div id="Modal2{{$value}}" class="modal">
    <div class="modal-content setting animate__animated animate__zoomIn" style="text-align:center">
        <li class="one"><label style="font-size: 20px;">QRCODE</label><span class="float-right cs" id="exits2{{$value}}" style="right: 15px;position: absolute;top: 0;font-size: 33px;">&times;</span></li>
        <img class="img-thumbnail" src="{{ pare_url_file('qrcode') }}" >
    </div>
</div> 
<!-- modal -->
<script>
$(function(){
    //hiện modal info
    $('#Btn{{$value}}').on('click',function(){
        $('#Modal{{$value}}').show();
    })
    $('#exits{{$value}}').on('click',function(){
        $('#Modal{{$value}}').hide();
    })
    $('#Modal{{$value}}').on('click',function(event){
        if(event.target ==  document.getElementById("Modal{{$value}}"))
            $(this).hide();
    }) 
            
   //hiện modal share
    $('#Btn1{{$value}}').on('click',function(){
        $('#Modal1{{$value}}').show();
    })
    $('#exits1{{$value}}').on('click',function(){
        $('#Modal1{{$value}}').hide();
    })
    $('#Modal1{{$value}}').on('click',function(event){
        if(event.target ==  document.getElementById("Modal1{{$value}}"))
            $(this).hide();
    })   
    //hiện modal qr
    $('#Btn2{{$value}}').on('click',function(){
        $('#Modal2{{$value}}').show();
        var url ="{{route('qrcode',$val->p_slug)}}";
        console.log(url);
        $.get({
            url:url,
            success:function(e){
                $('.img-thumbnail').attr('src',e.img); 
            }
        })
    })
    $('#exits2{{$value}}').on('click',function(){
        $('#Modal2{{$value}}').hide();
    })
    $('#Modal2{{$value}}').on('click',function(event){
        if(event.target ==  document.getElementById("Modal2{{$value}}"))
            $(this).hide();
    })   
})
</script>      
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0&appId=286256932921835&autoLogAppEvents=1" nonce="hO6WZe49"></script>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>