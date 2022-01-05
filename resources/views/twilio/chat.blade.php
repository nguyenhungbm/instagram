<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TWILIO CHAT</title>
</head>
<body>
    <div id="app">
        <chat-twilio-component :auth-user="{{ auth()->user() }}" :other-user="{{ $otherUser }}"></chat-twilio-component>
    </div>
</body>
<script src="https://media.twiliocdn.com/sdk/js/chat/v3.3/twilio-chat.min.js"></script>

<script src="{{ asset('js/app.js') }}"></script>
</html>