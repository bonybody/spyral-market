<?php

use Illuminate\Http\Request;
use App\Chat_message;
use App\Chat_room;
use App\Events\MessageAdded;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/messages', function (Request $request) {
    return Chat_message::where('room_id', $request->room_id)->get()->all();
});

Route::post('/send_message', function(Request $request){
//    header("Access-Control-Allow-Origin: *");  //CORS
//    header("Access-Control-Allow-Headers: Origin, X-Requested-With");
    $room_id = $request->room_id;
    $sender_id = $request->sender_id;
    $text = $request->text;
    $chat = Chat_message::create([
        'room_id' => $room_id,
        'sender_id' => $sender_id,
        'text' => $text,
    ]);
//    event((new MessageAdded($chat))->dontBroadcastToCurrentUser());
    return $chat;
});

Route::post('/apply_message', function (Request $request)
{
    event((new MessageAdded((object)$request->all()))->dontBroadcastToCurrentUser());
    $room = Chat_room::find($request->room_id);
    $room->updated_at = now();
    $room->save();
});
