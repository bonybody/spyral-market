<?php
use App\Chat_room;
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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('message-added-channel.{id}', function ($user, $id) {
    $room_users = Chat_room::find($id, ['seller_id', 'buyer_id'])->toArray();
    return in_array($user->id, $room_users);
});
