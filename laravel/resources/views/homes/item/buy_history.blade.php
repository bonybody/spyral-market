@extends('layouts.home')

@section('title', '購入履歴')

@section('head')
    <link rel="stylesheet" href="{{asset('css/homes/item/buy_history.css')}}">
@endsection

@section('main')
    @component('components.head')
        @slot('title', '購入履歴')
        @slot('caption', 'BUY HISTORY')
    @endcomponent

    <div class="items">
        @foreach($items as $item)
            @component('components.product')
                @slot('item', $item)
            @endcomponent
        @endforeach
    </div>
    <div class="paginate_link">{{$items->links()}}</div>

@endsection
