<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyItemController extends Controller
{
    public function index(Request $request)
    {
        return view('homes.my-item.index');
    }

    public function delete(Request $request)
    {
        $items = Item::where([
            'seller_id' => Auth::user()->id,
            'status' => 'sale',
            ])->with([
            'user', 'item_tags', 'item_tags.tag'])->get();
        $param = [
            'items' => $items
        ];
        return view('homes.my-item.delete', $param);
    }

    public function push_delete(Request $request)
    {
        $item_id = $request->id;
        Item::where('id', $item_id)->delete();
        return redirect('/home/my_item/delete');
    }
}
