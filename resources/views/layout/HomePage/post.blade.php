<div class="cs cse {{ $key%3 == 1 ? 'uio' : '' }}"  id="myBtnn{{$val->id}}">
   <div class="clr csf">
      <i class="fa fa-heart"></i> 
      <p class="likes{{$val->id}}">{{ $val->p_favourite}}</p>
      <i class="fa fa-comment"></i> 
      <p class="comment{{$val->id}}"> {{$val->p_comment }}</p>
   </div>
   <img src="{{ pare_url_file($val->p_image,'profile') }}" class="lazyload" id="image{{$key}}">  
</div>
<div id="myModall{{$val->id}}" class="modal hei">
   <div class="csg">
      <img src="{{ pare_url_file($val->p_image,'profile') }}" class="csq"> 
      <div class="cle">
         <div class="heq">
            <div class="hew"><a href="{{ route('get.home-page',$val->user->user)}}"><img src="{{ pare_url_file($val->user->avatar,'user') }}" class="avatar_user_uploaded"></a> </div>
            <div class="hee">
               <p><a href="{{ route('get.home-page',$val->user->user)}}"><b>{{$val->user->c_name}} </a></b>
                  @if($val->user->id == $user->id)
                  @else
                  &#8729; <b>{{ __('translate.folowing')}}</b>
                  @endif
               </p>
            </div>
            @include('layout.infomation',['value'=>$val->id])
         </div>
         <div class="her hdl{{$val->id}}" id="hell">
            @if($val->p_content!='')
            <div class="clr het">
               <div class="hew"><a href="{{ route('get.home-page',$val->user->user)}}"><img src="{{ pare_url_file($val->user->avatar,'user') }}" class="avatar_user_uploaded"></a> </div>
               <div class="hep">
                  <p><a href="{{ route('get.home-page',$val->user->user)}}"><b>{{$val->user->c_name}}</a> </b> {{$val->p_content}}</p>
               </div>
               <i class="fa fa-ellipsis-h"></i> 
               <div class="os heo">{{ $val->created_at->diffForHumans($now) }} 
               </div>
            </div>
            @endif   
            <div class="list-comment{{$val->id}}">
               @foreach(\App\Models\Comment::where('c_post',$val->id)->orderBy('created_at','desc')->get() as $value => $cmt)  
               <div class="clr het hjk{{$value}} "  style="display:none">
                  <div class="hew"><a href="{{ route('get.home-page',$cmt->users->user)}}"><img src="{{ pare_url_file($cmt->users->avatar,'user') }}" class="{{ $cmt->c_user_id ==\Auth::id() ? 'avatar_user_uploaded' :''}}"></a> </div>
                  <div class="hep">
                     <p><b><a href="{{ route('get.home-page',$cmt->users->user)}}">{{$cmt->users->c_name}}</a> </b> {{$cmt->c_comment}}</p>
                  </div>
                  <i class="fa fa-ellipsis-h"></i>
                  <div class="os heo">{{ $cmt->created_at->diffForHumans($now) }} </div>
               </div>
               @endforeach
            </div>
            <div class="buttons"><button class="button{{$val->id}} ">+</button> </div>
            <script>
               $('.button{{$val->id}}').on('click',function(){  
                     loadmore(); 
               }) 
               currentindex=0;
               maxindex ="{{\App\Models\Comment::where('c_post',$val->id)->count()}}";
               function loadmore(){ 
               x=  window.scrollY;
               var maxresult = 5;
               
               for(var i = 0; i < maxresult; i++)
               {
                  $(".hjk"+(currentindex+i)).show();
               }
               if(currentindex+5>=maxindex){
                  $('.button{{$val->id}}').hide();
               }
               window.scrollTo(0,x);
               currentindex += maxresult;
               
               }
               
               loadmore();
            </script>
         </div>
         <div class="hey">
            @include('layout.attraction_button',['value'=>$val->id])
            <p class="f-6 "><b class="view{{$val->id}}">{{$val->p_view}}</b> {{ __('translate.views')}}</p>
            <p class="f-6 " style="margin-top:-6px"> @include('layout.like',['value'=>$val->id])</p>
            <p class="os">{{ $val->created_at->diffForHumans($now) }}</p>
         </div>
         @include('layout.comment',['value'=>$val->id])
      </div>
   </div>
</div>
<script>   
   //click để scroll đến cuối trang
      // $('body').on('click','#myBtnn{{$val->id}}',function(){
      //    var $div = $("#hell"); 
      //    $div.scrollTop($div[0].scrollHeight);
      // })
       
      //hiện modal bài viết 
    
      var thismodal{{$val->id}} = document.getElementById("myModall{{$val->id}}"); 
      var thisbtn{{$val->id}} = document.getElementById("myBtnn{{$val->id}}"); 
      var html=document.getElementsByTagName("html");
      thisbtn{{$val->id}}.onclick = function() {
      thismodal{{$val->id}}.style.display = "block";
      var post='{{$val->id}}';
      var URL ="{{ route('post.increview')}}";  
      $.get({
         url:URL,
         data:{post:post},
         success:function(e){  
            $('.view{{$val->id}}').text(e.p_view);
         }
      })
      }   
      //ẩn modal bài viết
      thismodal{{$val->id}}.onclick = function(event) {   
         if (event.target == thismodal{{$val->id}}) {    
         thismodal{{$val->id}}.style.display = "none";
        
         }
      } 
</script>