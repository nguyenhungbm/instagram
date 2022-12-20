<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Website kết nối mọi người với nhau , cùng nhau chia sẻ những khoảnh khắc đáng nhớ">

    <title>Instagram</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

    @if(session('toastr'))
        <script>
            var TYPE_MESSAGE = "{{session('toastr.type') }}";
            var MESSAGE = "{{session('toastr.messages') }}";

        </script>
    @endif
</head>
<body>
<section>
    <div class="img">
        <img src="{{asset('img/lock.png') }}">
    </div>
    <b>Bạn gặp sự cố khi đăng nhập?</b>
    <p>Nhập email, số điện thoại hoặc tên người dùng của bạn và chúng tôi sẽ gửi cho bạn một liên kết để truy cập lại
        vào tài khoản.</p>

    <form action="" method="POST">
        @csrf
        <div class="username">
            <input type="text" name="email" placeholder="Số di động hoặc email" autocomplete="off">
            @if($errors->first('email'))
                <span class="text-danger">{{$errors->first('email') }}</span>
            @endif
        </div>
        <br>
        <button type="submit">Gửi liên kết đăng nhập</button>
    </form>
    <br>
    <div class="or">
        <div class="bar"></div>
        <div class="content">Hoặc</div>
        <div class="bar"></div>
    </div>
    <br><br>
    <a href="{{ route('register') }}">Tạo tài khoản mới</a>
    <div class="end-login">
        <a href="{{ route('login') }}" style="color:white"> Quay lại trang đăng nhập</a>
    </div>
</section>

</body>

<script src="https://use.fontawesome.com/452826394c.js"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-full-width",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    if (typeof TYPE_MESSAGE != "undefined") {
        switch (TYPE_MESSAGE) {
            case 'success':
                toastr.success(MESSAGE)
                break;
            case 'error':
                toastr.error(MESSAGE)
                break;
        }
    }

</script>
</html>