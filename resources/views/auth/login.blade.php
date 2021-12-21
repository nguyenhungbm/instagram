<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Website kết nối mọi người với nhau , cùng nhau chia sẻ những khoảnh khắc đáng nhớ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <meta name="theme-color" content="#4285f4">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home-page.css') }}">
    <link rel="stylesheet" href="{{ asset('library/sweetalert/dist/sweetalert2.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ asset('library/puzzle-captcha/src/disk/slidercaptcha.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Đăng nhập</title>
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    @if(session('toastr'))
    <script>
    var TYPE_MESSAGE = "{{session('toastr.type') }}";
    var MESSAGE = "{{session('toastr.messages') }}";
    </script>
    @endif
    <script>
    $(function() {
        $(window).bind("load", function() {
            jQuery(".loading").delay(6000).fadeOut();
        });
    })
    </script>
     <!-- refresh CSRF -->
     <script type="text/javascript">
            var csrfToken = $('[name="csrf_token"]').attr('content');
 
            setInterval(refreshToken, 3600000); // 1 hour 
 
            function refreshToken(){
                $.get('refresh-csrf').done(function(data){
                    csrfToken = data; // the new token
                });
            }
 
            setInterval(refreshToken, 3600000); // 1 hour 
 
        </script>
</head>

<body>
    <div class="loading"> 
        <div class="loadding"></div>
        <div id="typed-strings" style="display:none">
            <h1>WELCOME TO MY WEBSITE</h1>
            <h1><span>ENJOY</span> AND <span>RELAX</span> WITH IT</h1>
        </div>
        <span id="typed"></span>
    </div>
    <div class="login-left">
        <img src="{{ asset('img/login.png') }}">
    </div>
    <div class="login-right">
        <div class="login">
            <div class="logo"><img src="{{ asset('img/logo.png') }}"></div>
            <form action="" method="POST">
                @csrf
                <div class="error text-danger"></div>
                <div class="username">
                    <input type="text" id="username" name="email" autocomplete="off">
                    <label for="username" class="label-user">Số điện thoại, tên người dùng hoặc email</label>
                </div>
                @if($errors->first('email'))
                <span class="text-danger">{{$errors->first('email') }}</span>
                @endif
                <div class="username">
                    <input type="password" class="password" id="password" name="password">
                    <label for="password" class="label-password">Mật khẩu</label>
                    <i class="fa fa-lg fa-eye-slash click"></i>
                </div>
                @if($errors->first('password'))
                <span class="text-danger">{{$errors->first('password') }}</span>
                @endif
                <button type="button" id="myBtn-4">Đăng nhập</button>
            </form>
            <div class="or">
                <div class="bar"></div>
                <div class="content">Hoặc</div>
                <div class="bar"></div>
            </div>
            <br><br>
            <div class="qr-login">
                <a href="javascript:;" id="myBtn"><i class="fa fa-lg fa-qrcode"></i> Đăng nhập bằng mã qr</a>
            </div>
            <div class="fb-login">
                <a href="{{ url('/auth/redirect/facebook') }}"><i class="fa fa-lg fa-facebook-square"></i> Đăng nhập
                    bằng facebook</a>
            </div>
            <div class="google-login">
                <a href="{{ url('/auth/redirect/google') }}"><i class="fa fa-lg fa-google-plus-square"></i> Đăng nhập
                    bằng Google</a>
            </div>
            <div class="forget-password">
                <a href="{{ route('password.request') }}">Quên mật khẩu</a>
            </div>
        </div>
    </div>
    <div class="register">
        <span>Bạn chưa có tài khoản</span>
        <a href="{{ route('register') }}">Đăng ký</a>
    </div>
    <div id="myModal-4" class="modal">
        <div class="modal-content setting animate__animated animate__zoomIn" style="text-align:center">
            <div class="container-fluid">
                <div class="form-row">
                    <div class="col-12" style="min-height:300px">
                        <div class="slidercaptcha card" style="border:none">
                            <div class="card-header">
                                <span>Security Verification</span>
                            </div>
                            <div class="card-body">
                                <div id="captcha"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal user image -->
    <div id="myModal" class="modal">
        <h2 style="color:white">Đăng nhập bằng mã qr</h2>
        <video id="preview" width="100%"></video>
    </div>
    <script>
    $(function() {
        if ($('#username').val().length) {
            $(".label-user").css({
                "font-size": "11px",
                "transform": "translateY(-11px)"
            });
        }
        $(".label-user").on('click', function() {
            $(this).css({
                "font-size": "11px",
                "transform": "translateY(-11px)"
            });
        })
        $("#username").on("keyup", function() {
            var x = document.getElementById("username");
            if (x.value.length > 0) {
                $(".label-user").css({
                    "font-size": "11px",
                    "transform": "translateY(-11px)"
                });
            } else {
                $(".label-user").css({
                    "font-size": "15px",
                    "transform": "translateY(0px)"
                });
            }
        })
        if ($('#password').val().length) {
            $(".label-password").css({
                "font-size": "11px",
                "transform": "translateY(-11px)"
            });
        }
        $(".label-password").on('click', function() {
            $(this).css({
                "font-size": "11px",
                "transform": "translateY(-11px)"
            });
        })
        $("#password").on("keyup", function() {
            var x = document.getElementById("password");
            if (x.value.length > 0) {
                $(".label-password").css({
                    "font-size": "11px",
                    "transform": "translateY(-11px)"
                });
            } else {
                $(".label-password").css({
                    "font-size": "15px",
                    "transform": "translateY(0px)"
                });
            }
        })
    })
    </script>
</body>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>
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
<script src="{{ asset('library/sweetalert/dist/sweetalert2.all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="{{ asset('library/puzzle-captcha/src/disk/longbow.slidercaptcha.min.js') }}"></script>
<script>
var captcha = sliderCaptcha({ 
    id: 'captcha',
    repeatIcon: 'fa fa-redo',
    onSuccess: function() {
        var handler = setTimeout(function() {
            window.clearTimeout(handler);
            var email = $('#username').val();
            var password = $('#password').val();
            var url = " {{route('login') }}";
            $.post({
                url: url,
                data: {
                    email: email,
                    password: password
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    if(res.errors){
                        Swal.fire({
                            icon: 'error',
                            text: res.message,
                        })
                        $('.modal').hide()
                    }
                    if (res.status == 400) {
                        Swal.fire({
                            title: res.message,
                            width: 600,
                            padding: '3em',
                            background: "#fff url('{{ asset('library/sweetalert/images/trees.png') }}')",
                            backdrop: `
                              rgba(0,0,123,0.4)
                              url("{{ asset('library/sweetalert/images/cat.gif') }}")
                              left top
                              no-repeat
                              `
                        })
                    } else if (res.status == 200) {
                        Swal.fire({
                            icon: 'error',
                            text: res.message,
                        })
                        $('.modal').hide()
                    } else {
                        window.location.href = "/";  
                    }
                }
            })
        }, 500);
    }
});

</script>

<script>
$('#myBtn').on('click', function() {
    $('#myModal').show();
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            alert('No cameras found');
        }
    }).catch(function(e) {
        console.error(e);
    });

    scanner.addListener('scan', function(value) {
        var url = "{{ route('login.qr') }}";
        $.get({
            url: url,
            data: {
                token: value
            },
            success: function(e) {
                if (e == 1) {
                    window.location.href = "/";
                } else {
                    alert('Mã QR không hợp lệ');
                }
            }
        })
    });
})
$('#myBtn-4').on('click', function() {
    $("#myModal-4").show();
    captcha.reset();
})
$('#myModal').on('click', function(event) {
    if (event.target == document.getElementById("myModal"))
        $(this).hide()
})

$('#myModal-4').on('click', function(event) {
    if (event.target == document.getElementById("myModal-4"))
        $(this).hide()
})
</script>
<script>
var typed = new Typed('#typed', {
    stringsElement: '#typed-strings',
    loop: true,
    typeSpeed: 40,
    backSpeed: 40,
});
</script>
<script>
$(".click").on("click", function() {
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