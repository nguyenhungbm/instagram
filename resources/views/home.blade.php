<!DOCTYPE html>
<html  lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Call</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    @if(auth()->user())
    <script>
        window.user = {
            id: {{ auth()->id() }},
            name: "{{ auth()->user()->c_name }}"
        };

        window.csrfToken = "{{ csrf_token() }}";
    </script>
    @endif 
</head>
<body>

    <div id="example"></div>
</body>
<script src="{{ asset('js/app.js') }}" defer></script>
</html>