        <div class="cs cse {{ $key%3 == 1 ? 'uio' : '' }}"  id="myBtnn{{$val->id}}">
            <input type="hidden" value="{{ $val->p_slug}}" id="slug{{$val->id}}">
            <div class="csf">
                <i class="fa fa-heart"></i> 
                <p class="likes{{$val->id}}">{{ $val->p_favourite}}</p>
                <i class="fa fa-comment"></i> 
                <p class="comment{{$val->id}}"> {{$val->p_comment }}</p>
            </div>
            <img src="{{ pare_url_file($val->p_image, 'profile/img_small') }}" id="image{{$key}}">
        </div>
        <div id="myModall{{$val->id}}" class="modal hei">
            <div class="csg">
                <img src="{{ pare_url_file($val->p_image, 'profile/img_large') }}" class="csq"> 
                <div class="cle">
                    <div class="heq">
                        <div class="hew"><a href="{{ route('get.home-page', $val->user->user)}}"><img src="{{ pare_url_file($val->user->avatar, 'user') }}" class="avatar_user_uploaded"></a> </div>
                        <div class="hee">
                            <p><a href="{{ route('get.home-page', $val->user->user)}}"><b>{{$val->user->c_name}} </a></b>
                                @if($val->p_user== $user->id)
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
                            <div class="hew"><a href="{{ route('get.home-page', $val->user->user)}}"><img src="{{ pare_url_file($val->user->avatar, 'user') }}" class="avatar_user_uploaded"></a> </div>
                            <div class="hep">
                                <p><a href="{{ route('get.home-page', $val->user->user)}}"><b>{{$val->user->c_name}}</a> </b> {{$val->p_content}}</p>
                            </div>
                            <i class="fa fa-ellipsis-h"></i> 
                            <div class="os heo">{{ $val->created_at->diffForHumans() }} 
                            </div>
                        </div>
                        @endif   
                        <div class="list-comment{{$val->id}}">
                            @foreach(\App\Models\Comment::where('c_post', $val->id)->orderBy('created_at', 'desc')->get() as $value => $cmt)  
                            <div class="clr het hjk{{$value}} "  style="display:none">
                                <div class="hew"><a href="{{ route('get.home-page', $cmt->users->user)}}"><img src="{{ pare_url_file($cmt->users->avatar, 'user') }}" class="{{ $cmt->c_user_id ==\Auth::id() ? 'avatar_user_uploaded' :''}}"></a> </div>
                                <div class="hep">
                                    <p><b><a href="{{ route('get.home-page', $cmt->users->user)}}">{{$cmt->users->c_name}}</a> </b> {{$cmt->c_comment}}</p>
                                </div>
                                <i class="fa fa-ellipsis-h"></i>
                                <div class="os heo">{{ $cmt->created_at->diffForHumans() }} </div>
                                <input type="hidden" id="com{{ $val->id }}" value="{{\App\Models\Comment::where('c_post', $val->id)->count()}}">
                            </div>
                            @endforeach
                        </div>
                        @if(\App\Models\Comment::where('c_post', $val->id)->count() > 5)
                        <div class="buttons"><button class="button{{$val->id}} ">+</button> </div>
                        @endif
                        <script>
                            $('body').on('click', '.button{{$val->id}}',function(){  
                                loadmore("{{$val->id}}"); 
                            }) 
                            var currentindex=0;
                            function loadmore(id){ 
                            var max = $("#com"+id).val();
                                console.log(currentindex + " " + max);
                            if(currentindex + 5 >= max){
                                $('.button'+id).hide();
                            }
                            x=  window.scrollY;
                            var maxresult = 5;
                            
                            for(var i = 0; i < maxresult; i++)
                            {
                            $(".hjk"+(currentindex+i)).show();
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
                        <p class="os">{{ $val->created_at->diffForHumans() }}</p>
                    </div>
                    @include('layout.comment',['value'=>$val->id])
                </div>
            </div>
        </div>
        <script>   
            //click để scroll đến cuối trang
            // $('body').on('click', '#myBtnn{{$val->id}}',function(){
            //    var $div = $("#hell"); 
            //    $div.scrollTop($div[0].scrollHeight);
            // })
                
            //hiện modal bài viết
            
            
            $(function(){
            $('#myBtnn{{$val->id}}').on('click',function(event){
            if(screen.width >800){
                $('#myModall{{$val->id}}').show();
                var post='{{$val->id}}';
                var URL ="{{ route('post.increview')}}";  
                $.get({
                    url:URL,
                    data:{post:post},
                    success:function(e){  
                    }
                })
            }else{
                var slug = $('#slug{{$val->id}}').val();
                window.location.href='/p/'+slug;
            }
            })
            $('#myModall{{$val->id}}').on('click',function(event){
            if(event.target == document.getElementById("myModall{{$val->id}}")) 
                $(this).hide();
            })
            })            
        </script>     