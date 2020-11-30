<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\MessageAdded;
use App\Follow;
use App\Http\Requests\ProfileEditRequest;
use App\Http\Requests\PutUpItemRequest;
use App\Item;
use App\Sub_category;
use App\Subject_course_relation;
use App\Tag;
use App\Taken_subject;
use App\User;
use App\user_detail;
use App\Subject;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function foo\func;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('user');

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $recommendItems = Item::where('seller_id', '!=', Auth::user()->id)
            ->where('status', 'sale')
            ->whereHas('item_tags', function ($query) {
                $query->whereHas('tag', function ($query) {
                    $query->whereHas('sbj_tag_link', function ($query) {
                        $query->whereHas('subject', function ($query) {
                            $query->whereIn('id', Subject::whereHas('taken_subject', function ($query) {
                                $query->where('user_id', Auth::user()->id);
                            })->get('id')->toArray());
                        });
                    });
                });
            })->take(10)->get();

        $newItems = Item::where('status', 'sale')
            ->where('seller_id', '!=', Auth::user()->id)->take(10)->get();
        $param = [
            'recommendItems' => $recommendItems,
            'newItems' => $newItems,
        ];
        return view('homes.home', $param);
    }


    public function user(Request $request)
    {
        $user = User::find($request->id);
        $follow = Follow::where('user_id', Auth::user()->id)
            ->where('followed_user_id', $request->id)
            ->get();
        $param = [
            'follow' => $follow,
            'user' => $user,
        ];
        return view('homes.users', $param);
    }

    public function user_edit_get(Request $request)
    {
        $user = Auth::user();
        $my_subjects = [];
        $subjects = Subject_course_relation::where('course_id', '=', $user->course_id)->get();
        $my_subjects = Taken_subject::where('user_id', Auth::user()->id)->get()->toArray();
        foreach ($my_subjects as $my_subject) {
            $my_subjects[] = $my_subject['subject_id'];
        }

        $param = [
            'user' => $user,
            'my_subjects' => $my_subjects,
            'subject_relations' => $subjects,
        ];
        return view('homes.users_edit', $param);
    }

    public function user_edit_post(ProfileEditRequest $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->save();

        $user_detail = User_detail::where('user_id', $request->id)->first();
        $user_detail->message = $request->message;
        if (!empty($request->image)) {
            $user_image_path = $request->image->store('public/users');
            $user_detail->image = basename($user_image_path);
        }
        $user_detail->save();


        Taken_subject::where('user_id', $request->id)->delete();
        if (!empty($request->subject)) {
            foreach ($request->subject as $subject) {
                $subjects[] = [
                    'user_id' => $user->id,
                    'subject_id' => $subject,
                    'created_at' => now(),
                ];
            }
            Taken_subject::insert($subjects);
        }

        return redirect('home/user/' . $request->id);
    }


    public function new_item(Request $request)
    {
        $newItems = Item::where('status', 'sale')
            ->where('seller_id', '!=', Auth::user()->id)
            ->orderBy('created_at', 'desc')->paginate(15);
        $param = [
            'newItems' => $newItems,
        ];
        return view('homes.new_item', $param);
    }


}
