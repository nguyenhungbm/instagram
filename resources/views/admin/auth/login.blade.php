<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!--author:starttemplate-->
<!--reference site : starttemplate.com-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords"
          content="unique login form,leamug login form,boostrap login form,responsive login form,free css html login form,download login form">
    <meta name="author" content="leamug">
    <title>Đăng nhập</title>
    <link href="css/style.css" rel="stylesheet" id="style">
    <!-- Bootstrap core Library -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<style> 
body {
  background-image:url('https://i.redd.it/o8dlfk93azs31.jpg');
  background-position:center;
  background-size:cover;
  
  -webkit-font-smoothing: antialiased;
  font: normal 14px Roboto,arial,sans-serif;
  font-family: 'Dancing Script', cursive!important;
  font-size:24px;
  overflow:hidden;
  margin-top:50px
}
 
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    color: #ffffff!important;
    opacity: 1; /* Firefox */ 
}
.form-login {
    background-color: rgba(0,0,0,0.55);
    padding-top: 10px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 15px;
    border-color:#d2d2d2;
    border-width: 5px;
    color:white;
    box-shadow:0 1px 0 #cfcfcf;
}
.form-control{
    background:transparent!important;
  font-size:24px;
    color:white!important; 
}
h1{
    color:white!important;
}
h4 { 
 border:0 solid #fff; 
 border-bottom-width:1px;
 padding-bottom:10px;
  font-size:24px;
 text-align: center;
}

.form-control {
    border-radius: 10px;
}
.text-white{
    color: white!important;
}
.wrapper {
    text-align: center;
} 
</style>
<body>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="  text-center" style="margin:0 auto">
              <div class="form-login"></br>
              <form action="" method="POST">
              @csrf
                <h1>Instagram</h1><hr>
                </br>
                <input type="text" name="email" class="form-control input-sm chat-input" placeholder="username"/>
                </br></br>
                <input type="password" name="password" class="form-control input-sm chat-input" placeholder="password"/>
                </br></br>
                <div class="wrapper">
                        <span class="group-btn">
                            <button type="submit" class="btn btn-danger btn-md">Đăng nhập <i class="fa fa-sign-in"></i></button>
                        </span>
                </div>
            </div>
            <a href="{{ route('get.register.admin')}}">Đăng ký</a>
        </div>
    </div>
    </form>
    </br></br></br>
    <!--footer-->
    <div class="footer text-white text-center">
        <p>© 2020 Unique Login Form. All rights reserved | Design by <a href="https://freecss.tech">Free Css</a></p>
    </div>
    <!--//footer-->
</div>
</body>
</html>
