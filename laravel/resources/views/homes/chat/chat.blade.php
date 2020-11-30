@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="{{asset('css/homes/chat/chat.css')}}">
@endsection

@section('title', 'チャットルーム一覧')

@section('main')

    @component('components.head')
        @slot('title', 'ルーム一覧')
        @slot('caption', 'CHAT ROOMS')
    @endcomponent

    <chat-room-list-component
        :buyer_rooms="{{ ($buyer_rooms) }}"
        :seller_rooms="{{ ($seller_rooms) }}"
    ></chat-room-list-component>

@endsection
