@php use App\Models\Like; @endphp
@php use App\Models\Comment; @endphp
@foreach($posts as $key => $item)
    <article class="border-gray position-relative">
        <div class="header ">
            <a class="text-black" href="{{ $item->user->user}}"><img
                        src="{{ pare_url_file($item->user->avatar, 'user') }}"
                        class="rounded-circle  d-inline-block img-user">{{ $item->user->c_name}}</a>
            <div class="float-right"><a><img src="{{ asset('img/edit.png') }}" class="img-edit"></a></div>
        </div>
        <img src="{{pare_url_file($item->p_image, 'profile') }}" class="article-img">

        <div class="attractive">
            <div class="d-block">
                <div class="d-inline-block"><i
                            class="fa fa-15x heart{{$item->id}} {{ Like::checkLove($item->id) ? 'fa-heart text-red' :'fa-heart-o' }}"
                            onclick="likepost('{{$item->id}}')"></i></div>
                <div class="d-inline-block"><i class="fa fa-15x fa-comment-o"></i></div>
                <div class="d-inline-block"><i class="fa fa-15x fa-share-alt"></i></div>
                <div class="d-inline-block float-right"><i class="fa fa-15x fa-bookmark-o float-right"></i></div>
                <br>
                <b class="zxm"> <b
                            class="like{{$item->id}}">{{Like::where('r_post', $item->id)->count()}}</b> {{ __('translate.likes')}}
                </b>
                <div class="d-inline-block w-100">
                    <div class="status">
                        <a href="{{ $item->user->user}}"
                           class="text-black">{{$item->user->c_name}} </a>{{$item->p_content}} <br>
                        <br>
                    </div>
                    <div class="hdl{{$key}}">
                        @foreach(Comment::where('c_post', $item->id)->get() as $value=> $list)

                            <div class="chat w-100 position-relative hjk{{$value}}" style="display:none">
                                <a href="{{ $list->users->user}}"
                                   class="text-black">{{$list->users->c_name}}</a> {{ $list->c_comment}}
                                <i class="fa fa-heart-o float-right"></i>
                            </div>
                        @endforeach

                    </div>
                    <a href="javascript:" class="text-gray button{{$key}}">{{ __('translate.View more comments')}}</a>
                    <br>
                    <a href="" class="text-gray"
                       style="font-size:12px;line-height:30px">{{ $item->created_at->diffForHumans($) }} </a>
                    <hr>
                    <form class="position-relative form" action="{{ route('comment.post')}}">
                        <textarea rows="10" autocomplete="off" class="textarea-{{$key}} textarea-comment{{$key}}"
                                  placeholder="{{ __('translate.Add a comment')}}..."></textarea>
                        <input type="hidden" value="{{$item->id}}" class="post-comment{{$key}}">
                        <input type="hidden" value="{{Auth::id()}}" class="user-comment{{$key}}">
                        <input type="submit" class="os comment-submit submit-{{$key}} submit-comment{{$key}}"
                               value="{{ __('translate.Post')}}">
                        <img src="{{ asset('img/loading.gif')}}" class="w-30 loading{{$key}}"
                             style="display:none;position: absolute;right: 0;">
                    </form>
                </div>
                <div class="d-inline-block"></div>
            </div>
        </div>
    </article>
    <script>
        //load comment

        $('body').on('click', '.button{{$key}}', function () {

            loadmore({{$key}});
        })
        currentindex = 0;
        maxindex = "{{Comment::where('c_post', $item->id)->count()}}";

        function loadmore(id) {
            if (currentindex + 3 >= maxindex) {
                $('.button' + id).hide();
            }
            x = window.scrollY;
            var maxresult = 3;

            for (var i = 0; i < maxresult; i++) {
                $('.hjk' + (currentindex + i)).show();
            }

            window.scrollTo(0, x);
            currentindex += maxresult;
        }

        loadmore({{$key}});
        //yêu thích
        $('.heart{{$item->id}}').on('click', function () {
            $(this).toggleClass('text-red');
            $(this).toggleClass('fa-heart-o ');
            $(this).toggleClass('fa-heart');
        });
        //event comment
        $('.textarea-{{$key}}').on('keyup', function () {
            if (!$('.textarea-{{$key}}').val()) {
                $('.submit-{{$key}}').addClass('disabled');
                $('.submit-{{$key}}').addClass('os');
            } else {
                $('.submit-{{$key}}').removeClass('disabled');
                $('.submit-{{$key}}').removeClass('os');
            }
        })

        //comment
        $(".submit-comment{{$key}}").on('click', function (e) {
            e.preventDefault();
            var URL = $(this).parents('form').attr('action');
            var c_comment = $('.textarea-comment{{$key}}').val();
            var c_post = $('.post-comment{{$key}}').val();
            var c_user_id = $('.user-comment{{$key}}').val();

            $.get({
                url: URL,
                data: {c_comment: c_comment, c_post: c_post, c_user_id: c_user_id},
                beforeSend: function () {
                    $('.loading{{$key}}').show();
                    $('.submit-{{$key}}').addClass('os');
                },
                complete: function () {
                    $('.loading{{$key}}').hide();
                    $('.submit-{{$key}}').removeClass('os');
                }
            }).done(function (e) {
                $(".hdl{{$key}}").append(`
            <div class="chat w-100 position-relative">
                        <a href="/${e.user.user}" class="text-black">${e.user.c_name}</a> ${c_comment}
                        <i class="fa fa-heart-o float-right"></i> 
                     </div>  
         `);
                $('.textarea-comment{{$key}}').val('');
                $('.submit-comment{{$key}}').addClass('disabled');
            });
        })

    </script>
@endforeach