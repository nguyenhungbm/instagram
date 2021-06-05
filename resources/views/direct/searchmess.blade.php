<!-- nếu người dùng gõ trên 2 phím -->
@if(isset($val))
@foreach($val as $key=> $list)
<div class="clr py cs py{{$list->id}}"> 
    <img src="{{ pare_url_file($list->avatar,'user')}}" class="rounded-circle">
    <div> 
        <b>{{ $list->user}}</b><br>
        <p class="os">{{$list->c_name}}</p> 
    </div>
    <button class="cs hihi{{$key}}"><i class="fa fa-lg fa-check haha{{$key}}"></i></button>
</div>
<script> 
 $('.py{{$list->id}}').on('click',function(){
        if($('.hihi{{$key}}').hasClass('background-blue')){
            $('.hihi{{$key}}').removeClass('background-blue'); 
            $('.pt{{$key}}').remove();
            if(!$('.pw').children('div').hasClass('pt')){
                $('.nexts').addClass('disabled');
            }
        }else{  
            $('.nexts').removeClass('disabled');
            $('.hihi{{$key}}').addClass('background-blue'); 
            $('.pw').append(` 
                <div class="pt pt{{$key}}" id="pt pt{{$key}}">
                <a href="javascript:;">{{$list->user}} <span class="close{{$key}}">&times;</span></a> 
                </div> 
            `);
        }
    });   
 $('body').on('click','.close{{$key}}',function(){
    $('.pt{{$key}}').remove();
    $('.hihi{{$key}}').removeClass('background-blue'); 
            if($('.pu button').hasClass("background-blue")){
    $('.nexts').removeClass('disabled');
             }else{
    $('.nexts').addClass('disabled');
             }  
         })   
      </script> 
   @endforeach
@endif

<!-- nếu thanh tìm kiếm của người dùng để trống -->
@if(isset($chat))
<b class="pq">Được đề xuất</b>
@foreach($chat as $key=> $list)
<div class="clr py cs py{{$list->id}}"> 
    <img src="{{ pare_url_file($list->friends->avatar,'user')}}" class="rounded-circle">
    <div> 
        <b>{{ $list->friends->user}}</b><br>
        <p class="os">{{ $list->friends->c_name}}</p> 
    </div>
    <button class="cs hihi{{$key}}"><i class="fa fa-lg fa-check haha{{$key}}"></i></button>
</div>
<script> 
    $('.py{{$list->id}}').on('click',function(){
        if($('.hihi{{$key}}').hasClass('background-blue')){
            $('.hihi{{$key}}').removeClass('background-blue'); 
            $('.pt{{$key}}').remove();
            if(!$('.pw').children('div').hasClass('pt')){
                $('.nexts').addClass('disabled');
            }
            }else{  
                $('.nexts').removeClass('disabled');
                $('.hihi{{$key}}').addClass('background-blue'); 
                $('.pw').append(` 
                        <div class="pt pt{{$key}}" id="pt{{$key}}">
                            <a href="javascript:;">{{$list->friends->user}} <span class="close{{$key}}">&times;</span></a> 
                        </div> 
                        `);
            }
    });   
</script> 
@endforeach
@endif