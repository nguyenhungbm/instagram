<article class="border-gray position-relative">
    <div class="header ">
        <a class="text-black" href="{{ $val->user->user}}"><img src="{{ pare_url_file($val->user->avatar, 'user') }}" class="rounded-circle  d-inline-block img-user">{{ $val->user->c_name}}</a>
        <div class="float-right">
            @include('layout.infomation',['value'=>$val->id])
        </div>
        
    </div>
    <img src="{{pare_url_file($val->p_image, 'profile/img') }}" class="article-img" >
    <div class="attractive">
        <div class="d-block">
            @include('layout.attraction_button',['value'=>$val->id, 'link' => $val->p_image]) 
            @include('layout.like',['value'=>$val->id])
            <div class="d-inline-block w-100">
                <div class="status">
                <a href="{{ $val->user->user}}" class="text-black">{{$val->user->c_name}} </a>{{$val->p_content}}    
                <br>
                </div>
                <div class="list-comment-home{{$val->id}}">
                @foreach(\App\Models\Comment::where('c_post', $val->id)->get() as $value=> $list) 
                <div class="chat w-100 position-relative hjk{{$value}}" style="display:none">
                    <a href="{{ $list->users->user}}" class="text-black">{{$list->users->c_name}}</a>{{ $list->c_comment}}
                </div>
                @endforeach
                </div>
                @if(\App\Models\Comment::where('c_post', $val->id)->count() > 3 )
                <p class="text-gray cs button{{$val->id }}">{{ __('translate.View more comments')}}</p>
                @endif
                <span class="text-gray" style="font-size:13px">{{ $val->created_at->diffForHumans() }} </span>
                <hr>
                @include('layout.comment',['value'=>$val->id])
            </div>
        </div>
    </div>
</article>
<script> 
    $(function(){
        //load comment
        $('body').on('click', '.button{{$val->id}}',function(){  
            loadmore("{{$val->id}}");
        }) 
        var currentindex = 0;
        var max = "{{\App\Models\Comment::where('c_post', $val->id)->count() }}" ;
        function loadmore(id){  
            if(currentindex+3 >= max){
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
        loadmore("{{$val->id}}");
    })
</script>