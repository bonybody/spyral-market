@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/homes/follow/my_follow_items.css') }}">
@endsection

@section('title', 'フォローユーザの出品')

@section('main')
    <div id="follow_user_item">
        <div id="follow_user_item_title">
            @component('components.head')
                @slot('title', 'フォローユーザの出品')
                @slot('caption', 'ITEMS')
                @endcomponent
        </div>
        <div id="items_wrap">
            @foreach($items as $item)
                @component('components.product', ['item' => $item])
                @endcomponent
            @endforeach
            {{ $items->links() }}
        </div>
    </div>
@endsection
