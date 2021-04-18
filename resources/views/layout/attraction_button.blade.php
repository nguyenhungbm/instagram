@php
    $class=" fa-heart-o ";
    if(\App\Models\Like::checkLove($value))
    $class="fa-heart text-red";
@endphp
    <i class="fa fa-15x heart{{$value}} {{ $class }}" onclick="likepost('{{$value}}')"></i> 
    <i class="fa fa-15x fa-comment-o"></i> 
    <i class="fa fa-15x fa-share-alt"></i>
    <i class="fa fa-15x fa-bookmark-o float-right"></i><br>
<script> 
    $(function(){  
    $('.heart{{$value}}').on('click',function(){  
    $(this).toggleClass('text-red');
    $(this).toggleClass('fa-heart-o ');
    $(this).toggleClass('fa-heart');
     })
    }); 
</script>