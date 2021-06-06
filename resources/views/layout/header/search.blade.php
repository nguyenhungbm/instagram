<div class="search">
    <input type="text" name="search" id="input-search" class="input-search" placeholder="{{ __('translate.Search')}}" autocomplete="off">
    <img src="{{ asset('img/search.png') }}" class="w-15 yes search-2 ">
    <img src="{{ asset('img/delete.png') }}" class="w-15 float-right delete"> 
    <ul class="list d-none">
        <div class="div">
        <li class="nos d-none">
          <img src="{{ asset('img/loadingg.gif')}}" class="loaders">
        </li>
        </div>
    </ul>
</div>
<script> 
   $(function(){
    $('#input-search').on('keyup',function(){
        var val =$(this).val();  
        if(val.length >= 2){
            $('.list').removeClass('d-none');
            var URL="{{route('search')}}";   
            $.get({
                url:URL,
                data:{value:val},
                beforeSend:function(){
                    $('.nos').removeClass('d-none');
                },
                complete:function(){
                    $('.nos').addClass('d-none');
                },
                success:function(res){ 
                    $('.div').empty();
                    if(res == 0){
                        $(".div").prepend(`
                            <li class="no p-15">
                                {{ __("translate.No result found.")}}
                            </li>
                        `);  
                    }
                    else{
                        $('.no').addClass('d-none');
                        $(".div").prepend(res);  
                    }
            }
            })  
         } 
         else{
            $('.list').addClass('d-none');
         }
      })

      
    $(window).on('click',function(){
        $('.list').addClass('d-none');
    })
   })
</script> 