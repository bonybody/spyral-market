@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="{{ asset('./css/homes/search/subject.css') }}">
@endsection

@section('title', '科目検索')

@section('main')
    <div id="subject_search">
        <div id="search_subject">
            <p>検索科目: {{ $search_subject }}</p>
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
