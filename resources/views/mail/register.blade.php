<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .body {
            width: 100%;
            height: 100%;
            background-color: #f3f3f3;
            color: black
        }

        .p-15 {
            padding: 15px;
            background-color: #fff;
            width: 80%;
            margin: 0 auto;
        }

        .button {
            padding: 10px;
            border: none;
            background: #00b14f;
            border-radius: 5px;
            text-decoration: none;
        }

        .img {
            text-align: center;

        }

        .img img {
            width: 100px;
            height: 50px
        }
    </style>
</head>
<body>
<div class="body"><br>
    <div class="img"><img src="https://www.instagram.com/static/images/web/mobile_nav_type_logo.png/735145cfe0a4.png">
    </div>
    <br>
    <div class="p-15">
        <p>Xin chào <b> {{ $name}}</b>,</p>
        <p>Cảm ơn bạn đã đăng ký tài khoản trên Insta.es. Để có được trải nghiệm dịch vụ và được hỗ trợ tốt nhất, bạn
            cần hoàn thiện xác thực tài khoản.</p>
        <p>Vui lòng bấm nút Xác thực để hoàn tất quá trình này.</p>
        <div style="text-align:center"><a href="{{route('user.verify.gmail', $user)}}" class="button"
                                          style="color:white">Xác thực</a></div>
        <p> Liên hệ với chúng tôi để được hỗ trợ nhiều hơn:</p>
        <p> Hotline: <a href="tel:0948561668">0948561668</a></p>
        <p>Email: <a href="mailto:hung0913003358@gmail.com">hung0913003358@gmail.com</a></p>
        <b>Trân trọng,</b><br>
        <b>Nguyễn Hùng</b>
    </div>
    <br><br>
</div>
</body>
</html>