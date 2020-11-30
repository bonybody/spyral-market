@extends('layouts.home')

@section('title', '商品管理')

@section('main')
    @component('components.head')
        @slot('title', '商品管理')
        @slot('caption', 'ITEM CONTROL')
    @endcomponent
    <my-item-index></my-item-index>
@endsection
