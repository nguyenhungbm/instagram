<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Group;
//notification
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

//chat 
Broadcast::channel('Chat.{user_id}.{friend_id}', function ($user, $user_id,$friend_id) {
    return $user->id ==$friend_id;
});
//online
Broadcast::channel('Online', function ($user) {
    return $user;
});

Broadcast::channel('photos', function ($user) {
    return true;
});

Broadcast::channel('users.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
//group chat
Broadcast::channel('Groups.{group}', function ($user, Group $group) {
    return $group->hasUser($user->id);
});
