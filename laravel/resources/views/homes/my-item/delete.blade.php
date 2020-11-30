@extends('layouts.home')

@section('title', '削除')

@section('main')
    @component('components.head')
        @slot('title', '商品削除')
        @slot('caption', 'ITEM DELETE')
    @endcomponent
@csrf
    <my-item-delete-main :items="{{ ($items) }}"></my-item-delete-main>
@endsection
