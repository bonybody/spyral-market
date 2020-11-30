<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PutUpItemRequest;
use App\Item;
use App\Item_tag;
use App\Sub_category;
use App\Tag;
use Illuminate\Http\Request;

class PutUpController extends Controller
{
    public function put_up_get(Request $request)
    {

        $param = [
            'tags' => Tag::all(),
        ];
        return view('homes.put_up', $param);
    }

    public function put_up_post(PutUpItemRequest $request)
    {
        header("Access-Control-Allow-Origin: *");  //CORS
        header("Access-Control-Allow-Headers: Origin, X-Requested-With");

        $seller_id = $request->seller_id;
        $name = $request->name;
        $price = $request->price;
        $text = $request->text;
        $tags = explode(',',$request->tags[0]);
        $category = $request->category;
        $sub_category = $request->sub_category;

        if (!empty($request->image)) {
            $user_image_path = $request->image->store('public/items');
            $image = basename($user_image_path);
        } else {
            $image = $request->image;
        }


        $created_item = Item::create([
            'name' => $name,
            'price' => $price,
            'text' => $text,
            'seller_id' => $seller_id,
            'status' => 'sale',
            'category_id' => $category,
            'sub_category_id' => $sub_category,
            'image' => $image,
            'created_at' => now(),
        ]);

        $item_id = $created_item->id;

        $tag_params = [];
        $main_tags = [];
        if ($tags[0] !== null) {
            foreach($tags as $tag) {
                $main_tags[] = Tag::updateOrCreate(
                    ['name' => $tag], ['name' => $tag]
                );
            }
            foreach ($main_tags as $tag) {
                Item_tag::create([
                    'item_id' => $item_id,
                    'tag_id' => $tag->id,
                ]);
            }
        }


        return redirect(url('home/item/' . $created_item->id));

    }

}
