@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="{{asset('css/homes/search/tag_search.css')}}">
@endsection

@section('title', 'タグ検索')

@section('main')
    <div id="tag_search">
        <div id="search_tag">
            <p>検索タグ: {{ $search_tag }}</p>
        </div>
        <div id="items_wrap">
            @foreach($search_items as $item)
                @component('components.product', ['item' => $item])
                @endcomponent
            @endforeach
            {{ $search_items->links() }}
        </div>
    </div>
    @endsection
