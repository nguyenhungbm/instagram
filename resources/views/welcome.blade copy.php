<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Video Chat</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

        <style>
            * {
                font-family: 'Oxygen', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="btn">Add</div>
        <div id="app" style="display:none">
            <video-call></video-call>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
    <script>
    $('.btn').on('click',function(){
        $('#app').show();
    })
    </script>
</html>
