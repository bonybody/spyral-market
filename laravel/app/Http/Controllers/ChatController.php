<?php

namespace App\Http\Controllers;

use App\Chat_room;
use App\Http\Requests\roomRequest;
use Illuminate\Http\Request;
use App\Http\Requests\CompleteCheckRequest;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function get_rooms(Request $request)
    {
        $buyer_rooms = Chat_room::where('buyer_id', Auth::user()->id)->with(['item', 'seller', 'buyer'])->orderBy('updated_at', 'desc')->get();
        $seller_rooms = Chat_room::where('seller_id', Auth::user()->id)->with(['item', 'seller', 'buyer'])->orderBy('updated_at', 'desc')->get();
        $param = [
            'buyer_rooms' => $buyer_rooms,
            'seller_rooms' => $seller_rooms,
        ];
        return view('homes.chat.chat', $param);
    }

    public function room(Request $request)
    {
        $room_id = $request->id;
        if ($request->position == 'buyer') {
            $room = Chat_room::with([
                'item',
                'item.item_tags',
                'item.item_tags.tag',
                'item.item_tags.tag.sbj_tag_link',
                'item.item_tags.tag.sbj_tag_link.subject',
                'seller',
                'seller.course',
                'seller.school',
                'seller.user_detail',
            ])->find($room_id);
            if (isset($room->seller)) {
                $partner = $room->seller;
            } else {
                return redirect('/');
            }
            if ($partner->user_detail->image == null) {
                $partner->user_detail->image = 'no_image';
            }
            $item_tags = $room->item->item_tags;
        } else {
            $room = Chat_room::with([
                'item',
                'item.item_tags',
                'item.item_tags.tag',
                'item.item_tags.tag.sbj_tag_link',
                'item.item_tags.tag.sbj_tag_link.subject',
                'buyer',
                'buyer.course',
                'buyer.school',
            ])->find($room_id);
            if (isset($room->buyer)) {
                $partner = $room->buyer;
            } else {
                return redirect('/home');
            }
            if ($partner->user_detail->image == null) {
                $partner->user_detail->image = 'no_image';
            }
            $item_tags = $room->item->item_tags;
        }
        $item = $room->item;
        $param = [
            'room_id' => $room_id,
            'room' => $room,
            'partner' => $partner,
            'item' => $item,
            'item_tags' => $item_tags,
            'position' => $request->position,
        ];
        return view('homes.chat.chatroom', $param);
    }

    public function complete_check(CompleteCheckRequest $request)
    {
        $sender_id = $request->sender_id;
        $room = Chat_room::find($request->room_id);

        if ($room->seller_id == Auth::user()->id) {

            if ($room->seller_check > 0) {
                $room->seller_check -= 1;
            } else {
                $room->seller_check += 1;
            }

        } else {

            if ($room->buyer_check > 0) {
                $room->buyer_check -= 1;
            } else {
                $room->buyer_check += 1;
            }

        }
        if (($room->seller_check + $room->buyer_check) >= 2) {
            $room->item->status = 'sold';
            $room->item->save();
            $room->delete();
            return redirect('/home');
        } else {
            $room->updated_at = now();
            $room->save();
            return back();
        }
    }

}
