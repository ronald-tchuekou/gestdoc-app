<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('gestdoc-channel.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Admin channels.
Broadcast::channel('gestdoc-channel.admin', function ($user){
    return (string) $user->role === 'Admin';
});

// Root channels.
Broadcast::channel('gestdoc-channel.root', function ($user){
    return (string) $user->role === 'Root';
});

