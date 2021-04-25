<article class="border-gray position-relative">
<a href="{{pare_url_file($val->p_image,'profile/img') }}" download class="position-absolute" style="
    right: 15px;
    top: 75px;
    z-index: 100;
    color: white;" title="{{$val->p_image}}"> <span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-download fa-stack-1x"></i></span></a>
     
   <div class="header ">
      <a class="text-black" href="{{ $val->user->user}}"><img src="{{ pare_url_file($val->user->avatar,'user') }}" class="rounded-circle  d-inline-block img-user">{{ $val->user->c_name}}</a>
      <div class="float-right">
         @include('layout.infomation',['value'=>$val->id])
      </div>
    
   </div>
   <img src="{{pare_url_file($val->p_image,'profile/img') }}" class="article-img">
   <div class="attractive">
      <div class="d-block">
         @include('layout.attraction_button',['value'=>$val->id])
         @include('layout.like',['value'=>$val->id])
         <div class="d-inline-block w-100">
            <div class="status">
               <a href="{{ $val->user->user}}" class="text-black">{{$val->user->c_name}} </a>{{$val->p_content}}    
               <br>
            </div>
            <div class="hdl{{$key}}">
               @foreach(\App\Models\Comment::where('c_post',$val->id)->get() as $value=> $list) 
               <div class="chat w-100 position-relative hjk{{$value}}" style="display:none">
                  <a href="{{ $list->users->user}}" class="text-black">{{$list->users->c_name}}</a> {{ $list->c_comment}}
                  <i class="fa fa-heart-o float-right"></i> 
               </div>
               @endforeach
            </div>
            <p class="text-gray button{{$key}}">{{ __('translate.View more comments')}}</p>
            <span class="text-gray" style="font-size:13px">{{ $val->created_at->diffForHumans($now) }} </span>
            <hr>
            @include('layout.comment',['value'=>$val->id])
         </div>
      </div>
   </div>
</article>
<script> 
   $(function(){
      //load comment
      $('body').on('click','.button{{$key}}',function(){  
         
         loadmore({{$key}});
      }) 
      currentindex=0;
      maxindex ="{{\App\Models\Comment::where('c_post',$val->id)->count()}}";
      function loadmore(id){  
         if(currentindex+3 >= maxindex){
            $('.button'+id).hide();
         }
         x=  window.scrollY;
         var maxresult = 3;
      
         for(var i = 0; i < maxresult; i++)
            {
               $('.hjk'+(currentindex+i)).show();
            }
       
           window.scrollTo(0,x);
            currentindex += maxresult;
      }
      
        loadmore({{$key}});
   })
</script>