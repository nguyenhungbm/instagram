<!-- nếu người dùng gõ trên 2 phím -->
@if(isset($val))
    @foreach($val as $key=> $list)
        <div class="clr py cs py{{$list->id}}">
            <img src="{{ pare_url_file($list->avatar, 'user')}}" class="rounded-circle">
            <div>
                <b>{{ $list->user}}</b><br>
                <p class="os">{{$list->c_name}}</p>
            </div>
            <button class="cs hihi{{$list->id}} @if($list->isChecked) background-blue @endif"><i
                        class="fa fa-lg fa-check haha{{$list->id}}"></i></button>
        </div>
        <script>
            $(function () {
                $('.py{{$list->id}}').on('click', function () {
                    if ($('.hihi{{$list->id}}').hasClass('background-blue')) {
                        $('.hihi{{$list->id}}').removeClass('background-blue');
                        $('.pt{{$list->id}}').remove();
                        if (!$('.pw').children('div').hasClass('pt')) {
                            $('.nexts').addClass('disabled');
                        }
                    } else {
                        $('.nexts').removeClass('disabled');
                        $('.hihi{{$list->id}}').addClass('background-blue');
                        $('.pw').append(`
                <div class="pt pt{{$list->id}}" id="pt pt{{$list->id}}" data-id="{{$list->id}}" data-name="{{$list->c_name}}">
                <a href="javascript:;">{{$list->c_name}} <span class="close{{$list->id}}">&times;</span></a> 
                </div> 
            `);
                    }


                });
                $('body').on('click', '.close{{$list->id}}', function () {
                    $('.pt{{$list->id}}').remove();
                    $('.hihi{{$list->id}}').removeClass('background-blue');
                    if ($('.pu button').hasClass("background-blue")) {
                        $('.nexts').removeClass('disabled');
                    } else {
                        $('.nexts').addClass('disabled');
                    }
                })
            })
        </script>
    @endforeach
@endif

<!-- nếu thanh tìm kiếm của người dùng để trống -->
@if(isset($chat))
    <b class="pq">Được đề xuất</b>
    @foreach($chat as $key=> $list)
        <div class="clr py cs py{{$list->friend_id}}">
            <img src="{{ pare_url_file($list->friends->avatar, 'user')}}" class="rounded-circle">
            <div>
                <b>{{ $list->friends->user}}</b><br>
                <p class="os">{{ $list->friends->c_name}}</p>
            </div>
            <button class="cs hihi{{$list->friend_id}} @if($list->isChecked) background-blue @endif"><i
                        class="fa fa-lg fa-check haha{{$list->id}}"></i></button>
        </div>
        <script>
            $(function () {
                $('.py{{$list->friend_id}}').on('click', function () {
                    if ($('.hihi{{$list->friend_id}}').hasClass('background-blue')) {
                        $('.hihi{{$list->friend_id}}').removeClass('background-blue');
                        $('.pt{{$list->friend_id}}').remove();
                        if (!$('.pw').children('div').hasClass('pt')) {
                            $('.nexts').addClass('disabled');
                        }
                    } else {
                        $('.nexts').removeClass('disabled');
                        $('.hihi{{$list->friend_id}}').addClass('background-blue');
                        $('.pw').append(`
                    <div class="pt pt{{$list->friend_id}}" id="pt{{$list->friend_id}}"  data-id="{{$list->friends->friend_id}}" data-name="{{$list->friends->c_name}}">
                        <a href="javascript:;">{{$list->friends->c_name}} <span class="close{{$list->friend_id}}">&times;</span></a> 
                    </div> 
            `);
                    }
                });

                $('body').on('click', '.close{{$list->friend_id}}', function () {
                    $('.pt{{$list->friend_id}}').remove();
                    $('.hihi{{$list->friend_id}}').removeClass('background-blue');
                    if ($('.pu button').hasClass("background-blue")) {
                        $('.nexts').removeClass('disabled');
                    } else {
                        $('.nexts').addClass('disabled');
                    }
                })
            })
        </script>
    @endforeach
@endif 