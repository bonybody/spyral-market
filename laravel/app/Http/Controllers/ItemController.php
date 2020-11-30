<?php

namespace App\Http\Controllers;

use App\Category;
use App\Chat_room;
use App\Http\Requests\PutUpItemRequest;
use App\Item;
use App\Sales_history;
use App\Sub_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function foo\func;

class ItemController extends Controller
{
    //
    public function item(Request $request)
    {
        $item = Item::find($request->id);
        if (Auth::user()->id === $item->seller_id or ($item->status !== 'sale')) {
            $buy_possible_check = false;
        } else {
            $buy_possible_check = true;
        }

        $param = [
            'item' => $item,
            'buy_possible_check' => $buy_possible_check,
            'categories' => Category::all(),
            'sub_categories' => Sub_category::all(),
        ];
        return view('homes.items', $param);
    }

    public function buy(Request $request)
    {
        $item_id = $request->item_id;
        $buyer_id = $request->buyer_id;
        $seller_id = $request->seller_id;

        Sales_history::create([
            'item_id' => $item_id,
            'buyer_id' => $buyer_id,
            'seller_id' => $seller_id,
            'created_at' => now(),
        ]);

        $item = Item::find($item_id);
        $item->status = 'trade';
        $item->save();

        $chat_room = Chat_room::create([
            'item_id' => $item_id,
            'seller_id' => $seller_id,
            'buyer_id' => $buyer_id,
            'created_at' => now(),
        ]);
        return redirect('home/chat/room/'.$chat_room->id.'/buyer');
    }

    public function buy_history(Request $request)
    {
        $items = Item::where('status', 'trade')
            ->orWhere('status', 'sold')
            ->whereHas('sales_history', function ($query) {
                $query->where('buyer_id', Auth::user()->id);
            })->paginate(20);
        $param = [
            'items' => $items,
        ];
        return view('homes.item.buy_history', $param);
    }
}
