<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TWILIO VIDEO</title>
        <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

        <style>
            * {
                font-family: 'Oxygen', sans-serif;
            }
            video{
                position: absolute;
                width: 10%;
                z-index: 2;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <video-call></video-call>
        </div>
        <script src="https://media.twiliocdn.com/sdk/js/chat/v3.3/twilio-chat.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

