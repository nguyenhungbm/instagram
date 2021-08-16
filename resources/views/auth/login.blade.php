<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Website kết nối mọi người với nhau , cùng nhau chia sẻ những khoảnh khắc đáng nhớ">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
        <meta name="theme-color" content="#4285f4">
        <link rel="stylesheet" href="{{ asset('fontawesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/home-page.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <title>Đăng nhập</title>
        <!-- toastr -->
        <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
        @if(session('toastr'))
        <script>    
            var TYPE_MESSAGE="{{session('toastr.type') }}"; 
            var MESSAGE ="{{session('toastr.messages') }}";
        </script>
        @endif
        <script>
            $(function(){ 
                $(window).bind("load", function() {
                    jQuery(".loading").delay(6000).fadeOut();
                });
            })
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
            <img src="{{ asset('img/login.png') }}" >
        </div>
        <div class="login-right">
            <div class="login">
                <div class="logo"><img src="{{ asset('img/logo.png') }}" ></div>
                <form action="" method="POST">
                    @csrf
                    <div class="username">
                        <input  type="text" value="hung0913003358@gmail.com" class="username" id="username" name="email" placeholder="Số điện thoại, tên người dùng hoặc email" autocomplete="off">
                    </div>
                    @if($errors->first('email'))    
                    <span class="text-danger">{{$errors->first('email') }}</span>
                    @endif
                    <div class="username">
                        <input type="password" class="password" value="123456" id="password" name="password" placeholder="Mật khẩu" > 
                        <i class="fa fa-lg fa-eye-slash click"></i>     
                    </div>
                    @if($errors->first('password'))    
                    <span class="text-danger">{{$errors->first('password') }}</span>
                    @endif
                    <div style="display: flex;justify-content: center;">
                        <div class="g-recaptcha" data-sitekey="6LfpPWsbAAAAAP4NvOnJ1PQXeGDN1cdcEwAXflWo" ></div>
                    </div>
                    @if($errors->first('g-recaptcha-response'))    
                    <span class="text-danger">{{$errors->first('g-recaptcha-response') }}</span>
                    @endif
                    <button type="submit">Đăng nhập</button>
                </form>
                <div class="or" >
                    <div class="bar"></div>
                    <div class="content">Hoặc</div>
                    <div class="bar"></div>
                </div>
                <br><br>
                <div class="qr-login">
                    <a href="javascript:;" id="myBtn-5"><i class="fa fa-lg fa-qrcode"></i> Đăng nhập bằng mã qr</a>
                </div>
                <div class="fb-login">
                    <a href="{{ url('/auth/redirect/facebook') }}"><i class="fa fa-lg fa-facebook-square"></i> Đăng nhập bằng facebook</a>
                </div>
                <div class="google-login">
                    <a href="{{ url('/auth/redirect/google') }}"><i class="fa fa-lg fa-google-plus-square"></i> Đăng nhập bằng Google</a>
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
        <!-- modal user image -->
        <div id="myModal-5" class="modal">
            <h2 style="color:white">Đăng nhập bằng mã qr</h2>
            <video id="preview" width="100%"></video>
        </div>
        <script>
            $(function(){
                $("#username").on("keyup",function(){
                    var x = document.getElementById("username");
                    if(x.value.length>0){
                    $(".label-user").css({"font-size":"10px","transform":"translateY(-13px)"});
                    }
                    else{
                    $(".label-user").css({"font-size":"12px","transform":"translateY(0px)"});
                    }
                })
                $("#password").on("keyup",function(){
                    var x = document.getElementById("password");
                    if(x.value.length>0){
                    $(".label-password").css({"font-size":"10px","transform":"translateY(-13px)"});
                    }
                    else{
                    $(".label-password").css({"font-size":"12px","transform":"translateY(0px)"});
                    }
                }) 
            })
            
        </script>
    </body>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script>
        if(typeof TYPE_MESSAGE != "undefined"){
            switch (TYPE_MESSAGE){
                case 'success':
                    toastr.success(MESSAGE)
                    break;
                case 'error':
                    toastr.error(MESSAGE)
                    break;
            }
        }
        
        
    </script> 
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        $('#myBtn-5').on('click',function(){
        $('#myModal-5').show();
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
               Instascan.Camera.getCameras().then(function(cameras){
                   if(cameras.length > 0 ){
                       scanner.start(cameras[0]);
                   } else{
                       alert('No cameras found');
                   }
        
               }).catch(function(e) {
                   console.error(e);
               });
        
               scanner.addListener('scan',function(value){
                   var url = "{{ route('login.qr') }}";
                   alert(value);
                   $.get({
                    url:url,
                    data:{token:value},
                    success:function(e){
                        if(e == 1){
                            window.location.href="/";
                        }else{
                            alert('Mã QR không hợp lệ');
                        }
                    }
                   })
               });
            })
        $('#exit5').on('click',function(){
        $('#myModal-5').hide();
            })
        $('#myModal-5').on('click',function(event){
            if(event.target == document.getElementById("myModal-5")) 
            $(this).hide()
            })
        
         
    </script>
    <script>
        var typed = new Typed('#typed', {
          stringsElement: '#typed-strings',
          loop:true,
          typeSpeed: 40,
          backSpeed: 40,
        });
    </script>
    <script>
        $(".click").on("click",function(){
            $(this).toggleClass("fa-eye-slash");
            $(this).toggleClass("fa-eye");
            if($(this).hasClass("fa-eye-slash")){
                $('#password').attr('type', 'password');
            }
            if($(this).hasClass("fa-eye")){
                $('#password').attr('type', 'text');
            }
        })
    </script>
</html>