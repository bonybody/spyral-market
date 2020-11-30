@extends('layouts.home')

@section('title', 'キーワード検索')
@section('head')
    <link rel="stylesheet" href="{{asset('css/homes/search/key_word_search.css')}}">
@endsection
@section('main')
    <div id="keyword_search">
        <div id="search_word">
            <p>検索キーワード: "{{ $search_word }}"</p>
        </div>
        @if($search_category !== null)
            <div class="search_category"><p>選択カテゴリ: "{{ $search_category }}"</p></div>
            @if($search_sub_category !== null)
                <div class="search_category"><p>選択サブカテゴリ: "{{ $search_sub_category }}"</p></div>
            @endif
        @endif
        <div id="items_wrap">
            @foreach($search_items as $item)
                @component('components.product', ['item' => $item])
                @endcomponent
            @endforeach
            {{$search_items->links()}}
        </div>
    </div>
@endsection
