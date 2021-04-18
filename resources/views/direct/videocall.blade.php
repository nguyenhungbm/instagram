<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
.danger{
    color:white;
    background-color:red
}
img{
    height:150px;
    width: 150px;
    object-fit:cover;
}
</style>
<body>
<h1>Thông tin cá nhân</h1>
Tên :{{ Auth::user()->c_name}}<br>
Ảnh : <img src="{{Auth::user()->avatar}}" style="height:50px;width:50px"><br>
Email: {{Auth::user()->email}}
    <div class="container">
        <h1 class="text-center mt-5">Post FACEBOOK</h1>
        
        <table class="table table-hover">
            <thead>
            
                <tr>
                    <td>ID</td>
                    <td>Link</td>
                    <td>Message</td>
                    <td>Hình ảnh</td>
                </tr>
            </thead>
            <tbody  id="list">
                
            </tbody>
        </table>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    init();
function init(){
        var code=$('#code').val();
        var URL="https://graph.facebook.com/v10.0/me/feed?fields=id%2Cmessage%2Clink%2Cfull_picture&access_token=EAAEEWWLNIesBAKbLyUyL9LX6FnaDJBebUEeXgvaHvMvU2D7xfXsZB6oMNEizLYASUjUYfqCXAkgZAU2siuiZBMaM87NhYMP0TS6JsYKmLoBgr9Hg3vjIMT6QAJmhflNqdfVs06lo4q2a9reD1FNu0CKITDM0tHHxiZBBcxlP2dVyYWZCNwfft4ZAFMqggHSDEZD"; 
          $.ajax({   
              url:URL,
              method:"GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
              success:function(data){
                 for( var i=0;i<data.data.length;i++){

                 var row=`
                    <tr>
                        <td>${data.data[i].id}</td>
                        <td><a href="${data.data[i].link}" target="_blank">Nhấn vào đây</a></td>
                        <td>${data.data[i].message}</td>
                        <td><img src="${data.data[i].full_picture}" style="height:50px;width:50px"/></td> 
                        </tr>
                    `;
                 $('#list').append(row);
                 }
                 } 
          })
}
</script>
</body>
</html>