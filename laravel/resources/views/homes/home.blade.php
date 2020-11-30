@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="{{asset('css/homes/home.css')}}">
@endsection

@section('title', 'ホーム')

@section('main')
    <div class="items_wrap">
        @if(isset($recommendItems[0]))
        <div class="recommend">
            @component('components.head')
                @slot('title', 'おすすめ商品')
                @slot('caption', 'RECOMMEND')
            @endcomponent
            <div class="items">
                @foreach($recommendItems as $item)
                    @component('components.product', ['item' => $item])@endcomponent
                @endforeach
            </div>
        </div>
            <hr>
        @endif
        <div class="new">

            @component('components.head')
                @slot('title', '新着商品')
                @slot('caption', 'NEW ITEM')
            @endcomponent

            <div class="items">
                @foreach($newItems as $item)
                    @component('components.product', ['item' => $item])
                    @endcomponent
                @endforeach
            </div>
        </div>
    </div>
@endsection
