@extends('layouts.app')
@section('content')
    <pusher-video-call :allusers="{{ $users }}" :authUserId="{{ auth()->id() }}" turn_url="{{ env('TURN_SERVER_URL') }}"
                       turn_username="{{ env('TURN_SERVER_USERNAME') }}"
                       turn_credential="{{ env('TURN_SERVER_CREDENTIAL') }}"/>
@endsection