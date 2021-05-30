 
<i class="fa fa-ellipsis-h" id="Btn{{$value}}"></i>
<!-- modal infomation -->
<div id="Modal{{$value}}" class="modal">
   <div class="modal-content setting animate__animated animate__zoomIn" >
  
      @if($val->user->id != \Auth::id())
      <li><label class="text-red">{{ __('translate.Report')}}</label></li>
      @endif
      <li><a href="{{route('post.view',$val->p_slug)}}" >{{ __('translate.Go to post')}}</a> </li>
      <li id="Btn1{{$value}}"><label >{{ __('translate.Share to')}} ...</label></li>
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
   <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fa fa-facebook" style="margin-top:0;margin-right:5px"></i>{{ __('translate.Share to')}} Facebook</a>
   </div>
   </li>
   <li><a class="twitter-sh are-button" href="https://twitter.com/intent/tweet"> <i class="fa fa-twitter" style="margin-top:0"></i> {{ __('translate.Share to')}} Twitter</a> </li>
   <li> 
         <label class="zalo-share-button" data-href="{{ route('post.view',$val->p_slug) }}" data-layout="1" data-oaid="579745863508352884"  data-color="blue" data-customize=false></label>
   </li>
   <li class="cs" id="exits1{{$value}}"><label >{{ __('translate.Cancel')}}</label></li>
</div>

</div> 
                     <!-- modal -->
<script>
$(function(){
    //hiện modal info
          
    var modal{{$value}} = document.getElementById("Modal{{$value}}"); 
            var btn{{$value}} = document.getElementById("Btn{{$value}}");
            var exits{{$value}} = document.getElementById("exits{{$value}}"); 

            btn{{$value}}.onclick = function() {
            modal{{$value}}.style.display = "block";
            }   
            
            
   //hiện modal share
   var modal1{{$value}} = document.getElementById("Modal1{{$value}}"); 
            var btn1{{$value}} = document.getElementById("Btn1{{$value}}");
            var exits1{{$value}} = document.getElementById("exits1{{$value}}"); 
            btn1{{$value}}.onclick = function() {
               modal{{$value}}.style.display = "none";
               modal1{{$value}}.style.display = "block";  
            }   
               window.onclick = function(event) {   
               if (event.target == modal1{{$value}}) {    
               modal1{{$value}}.style.display = "none";
               }
               if (event.target == modal{{$value}}) {    
               modal{{$value}}.style.display = "none";
               }
            }
               //ẩn modal1 share

            exits1{{$value}}.onclick = function(event) {   
               modal1{{$value}}.style.display = "none";
            }
            //ẩn modal info
            exits{{$value}}.onclick = function(event) {   
               modal{{$value}}.style.display = "none";
            }
})
</script>      
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0&appId=286256932921835&autoLogAppEvents=1" nonce="hO6WZe49"></script>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>
