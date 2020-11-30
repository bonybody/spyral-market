<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Item;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function foo\func;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        $follow_user_id = $request->id;
        Follow::create([
            'user_id' => Auth::user()->id,
            'followed_user_id' => $follow_user_id,
            'created_at' => now(),
        ]);
        return back();
    }

    public function unfollow(Request $request)
    {
        $unfollow_user_id = $request->id;
        Follow::where('user_id', Auth::user()->id)
            ->where('followed_user_id', $unfollow_user_id)
            ->delete();

        return back();
    }

    public function my_follows(Request $request)
    {
        $users = User::whereHas('followers', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->paginate(20);
        $param = [
            'users' =>$users
        ];
        return view('homes.follow.my_follows', $param);
    }

    public function my_follow_items(Request $request)
    {
        $items = Item::whereHas('user', function ($query) {
            $query->whereHas('followers', function ($query) {
                $query->where('user_id', Auth::user()->id);
            });
        })->paginate(20);

        $param = [
            'items' => $items
        ];

        return view('homes.follow.my_follow_items', $param);
    }
}
