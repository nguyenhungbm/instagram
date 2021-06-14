<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website kết nối mọi người với nhau , cùng nhau chia sẻ những khoảnh khắc đáng nhớ">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> 
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
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
<style>
    
.loading{
    background-color: white;
    background-repeat: no-repeat;
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 100;
    display: flex;
    justify-content: center;
    align-items: center;
}
.loadding{
    background: url('/img/banner.jpg');
    background-repeat: no-repeat;
    position: fixed;
    top: 30%;
    left: 40%;
    width: 100%;
    height: 100%;
}
#typed{ 
    font-size: 50px;
    z-index: 9999999;
}

#typed h1{
    color: #000;
    font-family: 'Raleway',sans-serif;
    font-weight: 100;
    text-transform: uppercase;
    text-align: center;
    margin: 0;
}
#typed span{
    color:#84ff84 !important
}
</style>
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
            <button type="submit">Đăng nhập</button>
        </form>
        <div class="or" >
            <div class="bar"></div> 
            <div class="content">Hoặc</div>  
            <div class="bar"></div> 
        </div><br><br>
        <div class="fb-login">
            <a href="{{ url('/auth/redirect/facebook') }}"><i class="fa fa-lg fa-facebook-square"></i> Đăng nhập bằng facebook</a>
        </div>
        <div class="google-login">
            <a href="{{ url('/auth/redirect/google') }}"><i class="fa fa-lg fa-google-plus-square"></i> Đăng nhập bằng Google</a>
        </div> 
        <div class="forget-password">
            <a href="{{ route('get.forgot-password') }}">Quên mật khẩu</a>
        </div>
    </div>
</div>
        
    <div class="register">
        <span>Bạn chưa có tài khoản</span>
        <a href="{{ route('get.register') }}">Đăng ký</a>
    </div>
    <!-- <footer>
        <a href="">GIỚI THIỆU</a>
        <a href="">TRỢ GIÚP</a>
        <a href="">BÁO CHÍ</a>
        <a href="">API</a>
        <a href="">VIỆC LÀM</a>
        <a href="">QUYỀN RIÊNG TƯ</a>
        <a href="">ĐIỀU KHOẢN</a>
        <a href="">VỊ TRÍ</a>
        <a href="">TÀI KHOẢN LIÊN QUAN NHẤT</a>
        <a href="">HASHTAG</a>
        <a href="">NGÔN NGỮ</a>
        <p>&copy;  2020 INSTAGRAM FROM FACEBOOK</p>
    </footer> -->
    <script src="https://use.fontawesome.com/452826394c.js"></script>
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