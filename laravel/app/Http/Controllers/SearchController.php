<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Sub_category;
use App\Subject;
use App\Tag;
use Illuminate\Http\Request;
use function foo\func;

class SearchController extends Controller
{
    public function keyword(Request $request)
    {
        $keyword = $request->keyword;
        $category = $request->category;
        $sub_category = $request->sub_category;
        if (empty($keyword)) {
            return back();
        }
        if ($category == '大カテゴリを選択') {
            $items = Item::where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('text', 'LIKE', "%{$keyword}%")
                ->paginate(20);
        } elseif ($sub_category == '中カテゴリを選択') {
            $items = Item::where(function ($query) use ($keyword, $category) {
                $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('text', 'LIKE', '%' . $keyword . '%');
            })->where('category_id', $category)->paginate(20);
        } else {
            $items = Item::where(function ($query) use ($keyword, $sub_category) {
                $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('text', 'LIKE', '%' . $keyword . '%');
            })->where('sub_category_id', $sub_category)->paginate(20);
        }
        $category_name = null;
        $category_row = Category::find($category);
        if (isset($category_row->name)) {
            $category_name = $category_row->name;
        }
        $sub_category_name = null;
        $sub_category_row = Sub_category::find($sub_category);
        if (isset($sub_category_row->name)) {
            $sub_category_name = $sub_category_row->name;
        }
        $param = [
            'search_items' => $items,
            'search_word' => $keyword,
            'search_category' => $category_name,
            'search_sub_category' => $sub_category_name
        ];
        return view('homes.search.key_word_search', $param);
    }

    public function tag(Request $request)
    {
        $tag_id = $request->id;
        $tag_name = Tag::find($tag_id)->name;
        $items = Item::whereHas('item_tags', function ($query) use ($tag_id) {
            $query->where('tag_id', $tag_id);
        })->paginate(20);
        $param = [
            'search_items' => $items,
            'search_tag' => $tag_name,
        ];
        return view('homes.search.tag_search', $param);
    }

    public function subject(Request $request)
    {
        $subject_id = $request->id;
        $subject_name = Subject::find($subject_id)->name;
        $items = Item::whereHas('item_tags', function ($query) use ($subject_id) {
            $query->whereHas('tag', function ($query) use ($subject_id) {
                $query->whereHas('sbj_tag_link', function ($query) use ($subject_id) {
                    $query->where('subject_id', $subject_id);
                });
            });
        })->paginate(20);
        $param = [
            'search_items' => $items,
            'search_subject' => $subject_name,
        ];
        return view('homes.search.subject_search', $param);
    }
}
