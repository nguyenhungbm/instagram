@php
    $class=" fa-heart-o ";
    if(\App\Models\Like::checkLove($value))
    $class="fa-heart text-red";
@endphp
  <div class="d-flex" style="align-items: center;justify-content: space-between;width: 100px;">
   <i class="fa fa-15x heart{{$value}} {{ $class }}" onclick="likepost('{{$value}}')"></i> 
    <label for="coms"><i class="fa fa-15x fa-comment-o"></i></label> 
    <a href="{{pare_url_file($val->p_image,'profile/img') }}" download title="{{$val->p_image}}"> <span class="fa-stack fa-lg"><i class="fa fa-download fa-stack-1x"></i></span>
    </a>    
    </div>
<script> 
    $(function(){  
    $('.heart{{$value}}').on('click',function(){  
    $(this).toggleClass('text-red');
    $(this).toggleClass('fa-heart-o ');
    $(this).toggleClass('fa-heart');
     })
    }); 
</script>