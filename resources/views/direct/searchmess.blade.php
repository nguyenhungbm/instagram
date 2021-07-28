
<!-- nếu người dùng gõ trên 2 phím -->
@if(isset($val))
@foreach($val as $key=> $list)
<div class="clr py cs py{{$list->id}}"> 
    <img src="{{ pare_url_file($list->avatar,'user')}}" class="rounded-circle">
    <div> 
        <b>{{ $list->user}}</b><br>
        <p class="os">{{$list->c_name}}</p> 
    </div> 
    <button class="cs hihi{{$list->id}}"><i class="fa fa-lg fa-check haha{{$list->id}}"></i></button>
</div>
<script> 
$(function(){
     $('.py{{$list->id}}').on('click',function(){
        if($('.hihi{{$list->id}}').hasClass('background-blue')){
            $('.hihi{{$list->id}}').removeClass('background-blue'); 
            $('.pt{{$list->id}}').remove();
            if(!$('.pw').children('div').hasClass('pt')){ 
                $('.nexts').addClass('disabled');
            }
            for( var i = 0; i < users.length; i++){ 
                if ( users[i] === {{$list->id}}) { 
                    users.splice(i, 1); 
                }
            }
        }else{  
            users.push({{$list->id}});
            $('.nexts').removeClass('disabled');
            $('.hihi{{$list->id}}').addClass('background-blue'); 
            $('.pw').append(` 
                <div class="pt pt{{$list->id}}" id="pt pt{{$list->id}}">
                <a href="javascript:;">{{$list->user}} <span class="close{{$list->id}}">&times;</span></a> 
                </div> 
            `); 
        }
        $('#add_user').val(users);

    });   
    $('body').on('click','.close{{$list->id}}',function(){
        for( var i = 0; i < users.length; i++){ 
            if ( users[i] === {{$list->id}}) { 
                users.splice(i, 1); 
            }
        }
        $('.pt{{$list->id}}').remove();
        $('.hihi{{$list->id}}').removeClass('background-blue'); 
        if($('.pu button').hasClass("background-blue")){
            $('.nexts').removeClass('disabled');
        }
        else{
            $('.nexts').addClass('disabled');
        }  
        $('#add_user').val(users);
    })   
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
    <button class="cs hihi{{$list->id}}"><i class="fa fa-lg fa-check haha{{$list->id}}"></i></button>
</div>
<script> 
    $(function(){
        $('.py{{$list->id}}').on('click',function(){
        if($('.hihi{{$list->id}}').hasClass('background-blue')){
            $('.hihi{{$list->id}}').removeClass('background-blue'); 
            $('.pt{{$list->id}}').remove();
            if(!$('.pw').children('div').hasClass('pt')){
                $('.nexts').addClass('disabled');
            }
            for( var i = 0; i < users.length; i++){ 
                if ( users[i] === {{$list->friends->id}}) { 
                    users.splice(i, 1); 
                }
            }
        
        }else{  
            users.push({{$list->friends->id}});
            $('.nexts').removeClass('disabled');
            $('.hihi{{$list->id}}').addClass('background-blue'); 
            $('.pw').append(` 
                    <div class="pt pt{{$list->id}}" id="pt{{$list->id}}">
                        <a href="javascript:;">{{$list->friends->user}} <span class="close{{$list->id}}">&times;</span></a> 
                    </div> 
            `);
        }
        $('#add_user').val(users); 
    });   
    
    $('body').on('click','.close{{$list->id}}',function(){
        for( var i = 0; i < users.length; i++){ 
            if ( users[i] === {{$list->friend_id}}) { 
                users.splice(i, 1); 
            }
        }
        $('.pt{{$list->id}}').remove();
        $('.hihi{{$list->id}}').removeClass('background-blue'); 
        if($('.pu button').hasClass("background-blue")){
            $('.nexts').removeClass('disabled');
        }
        else{
            $('.nexts').addClass('disabled');
        }  
        $('#add_user').val(users);
    })  
    }) 
</script> 
@endforeach
@endif 