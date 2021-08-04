<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Call</title>
</head>
<style>
*{
    padding:0;
    margin:0;
    overflow: hidden;
}
.text-center{
    text-align:center
}
.black{
    background-color:black;
    width:100vw;
    height: 100vh;
}
.black .text-center:nth-child(2){
    position: absolute;
    bottom: -5px;
    right: 0;
}

.black .text-center:nth-child(1) video{
    height: 100vh;
}
.black .text-center:nth-child(2) video{
    width: 354px;
}
</style>
<body>
    <div id="app" class="black">
        <video-call></video-call>
    </div>
     <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>