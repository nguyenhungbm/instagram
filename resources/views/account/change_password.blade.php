<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi mật khẩu</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <style>
        * {
            padding: 0;
            margin: 0;
            overflow: hidden;
            outline: none
        }

        .header {
            width: 100vw;
            background: white;
            padding: 10px 50px
        }

        .img {
            width: 50px;
            height: 50px;
            border-radius: 50%
        }

        body {
            background: #fafafa
        }

        section {
            position: absolute;
            top: 15%;
            left: 35%;
            background: white;
            border: 1px solid #bdbdbd;
            border-radius: 5px;
            text-align: center;
            padding: 15px;
            width: 350px
        }

        input {
            width: 80%;
            height: 30px;
            margin-bottom: 20px;
            background-color: rgba(189, 189, 189, 0.09);
            border: 1px solid #bdbdbd;
            border-radius: 5px;
            padding-left: 7px
        }

        button {
            padding: 10px 20px;
            border: none;
            background: #0095f6;
            color: white;
            cursor: pointer;
            border-radius: 5px;

        }

        .username {
            position: relative
        }

        .text-danger {
            color: red;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 75%;
        }
    </style>
</head>
<body>
<div class="header"><img src="{{ asset('img/logo.png')}}"></div>
<section><br>
    <img src="{{ pare_url_file($user->avatar, 'user')}}" class="img">
    <p>{{$user->c_name}}</p>
    <br>
    <form action="" method="POST">
        @csrf
        <div class="username">
            <input type="password" name="password" placeholder="Mật khẩu mới">
            @if($errors->first('password'))
                <span class="text-danger">{{$errors->first('password') }}</span>
            @endif
        </div>
        <div class="username">
            <input type="password" name="re_password" placeholder="Xác nhận mật khẩu mới">

            @if($errors->first('re_password'))
                <span class="text-danger">{{$errors->first('re_password') }}</span>
            @endif
        </div>

        </div>
        <br>
        <button type="submit">Đổi mật khẩu</button>
    </form>
</section>

</body>

<script src="https://use.fontawesome.com/452826394c.js"></script>

<script>

    $(".click").on("click", function () {
        $(this).toggleClass("fa-eye-slash");
        $(this).toggleClass("fa-eye");
        if ($(this).hasClass("fa-eye-slash")) {
            $('#password').attr('type', 'password');
        }
        if ($(this).hasClass("fa-eye")) {
            $('#password').attr('type', 'text');
        }
    })

</script>
</html>