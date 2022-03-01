<div class="search">
    <input type="text" name="search" id="input-search" class="input-search" placeholder="{{ __('translate.Search')}}" autocomplete="off">
    <img src="{{ asset('img/search.png') }}" class="w-15 yes search-2 ">
    <img src="{{ asset('img/delete.png') }}" class="w-15 float-right delete"> 
    <ul class="lists d-none">
        <li class="nos d-none">
          <img src="{{ asset('img/loadingg.gif')}}" class="loaders">
        </li>
        <div class="div"> 
        </div>
    </ul>
</div>
<script> 
   $(function(){ 
       $(".delete").on('click',function(){
           $('.input-search').val("");
       })
        $('#input-search').on('keyup',function(){
            var val = $(this).val();  
            if(val.length >= 2){
                $('.lists').removeClass('d-none');
                var URL="{{route('search')}}";   
                $.get({
                    url:URL,
                    data:{value:val},
                    beforeSend:function(){
                        $('.div').empty();
                        $('.nos').removeClass('d-none');
                    },
                    complete:function(){
                    },
                    success:function(res){
                        setTimeout(function(){  
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
                        $('.nos').addClass('d-none');
                    },1000);
                }
                })  
            } 
            else{
                $('.lists').addClass('d-none');
            }
        })
        $(window).on('click',function(){
            $('.lists').addClass('d-none');
        })
    })
</script> 