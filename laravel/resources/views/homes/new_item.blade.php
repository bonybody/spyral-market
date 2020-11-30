@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="{{asset('css/homes/new_items.css')}}">
@endsection

@section('title', '新着商品')

@section('main')
    @component('components.head')
        @slot('title', '新着商品')
        @slot('caption', 'NEW ITEM')
    @endcomponent

    <div class="new_items">
        @foreach($newItems as $newItem)
            @component('components.product')
                @slot('item', $newItem)
            @endcomponent
        @endforeach
    </div>
    <div class="paginate_link">{{$newItems->links()}}</div>
@endsection
