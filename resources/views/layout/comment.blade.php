<form action="{{ route('comment.post')}}" class="clr position-relative ">
   @csrf
   <textarea autocomplete="off"  class="textarea-{{$value}} textarea-comment{{$value}} textarea-comment" placeholder="{{ __('translate.Add a comment')}}..."></textarea>
   <input type="hidden" value="{{$value}}" class="post-comment{{$value}}">   
   <button type="button" id="submit-{{$value}}" class="  button-comment disabled position-relative"><div class="position-absolute">{{ __('translate.Post')}}</div>
   <img src="{{ asset('img/loading.gif')}}" class="w-30 load-comment" style="display:none;">
   </button>
</form>
<script>
   //không cho người dùng đăng khi chưa comment
   $(function(){  
   $('.textarea-{{$value}}').on('keyup',function(event){
        event.preventDefault();
		if(!$('.textarea-{{$value}}').val())
			$('#submit-{{$value}}').addClass('disabled'); 
		else{ 
			$('#submit-{{$value}}').removeClass('disabled');
		if(event.keyCode === 13) {
			$('.textarea-{{$value}}').prop("disabled", true );
			document.getElementById("submit-"+{{$value}}).click();
		}
		}
   })
   
   //comment
   $("#submit-{{$value}}").on('click',function(e){
   e.preventDefault();
   var URL= $(this).parents('form').attr('action');
   var c_comment =$('.textarea-comment{{$value}}').val();
   var c_post = $('.post-comment{{$value}}').val();
   $.post({ 
   url:URL,
   headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
   data:{c_comment:c_comment,c_post:c_post},
   beforeSend:function(){
      $('.submit-{{$value}} div').hide();
      $('.load-comment').show();

   },
   complete:function(){
      $('.load-comment').hide();
      $('.submit-{{$value}} div').show();
   } 
   }).done(function(e){
   $('.comment{{$value}}').text(e.comment);
   $(".list-comment{{$value}}").prepend(`
   <div class="clr het">
   <div class="hew"><a href="/${e.user.user}"><img src="${e.avatar}" class="avatar_user_uploaded"></a> </div>
   <div class="hep"><p><b><a href="/${e.user.user}">${e.user.c_name}</a> </b>${c_comment}</p></div>
   <i class="fa fa-ellipsis-h"></i>
   <div class="os heo">1 giây trước </div>
   </div>
   `);
   $('.textarea-comment{{$value}}').val('');
   $('.submit-{{$value}}').addClass('disabled');
   
   // var $div = $("#hell"); 
   // $div.scrollBottom($div[0].scrollHeight); 
   });
   })
});
</script>