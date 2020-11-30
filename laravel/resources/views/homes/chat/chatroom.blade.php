@extends('layouts.no_side_home')

@section('head')
    <link rel="stylesheet" href="{{asset('css/homes/chat/chatroom.css')}}">
@endsection

@section('title', 'チャットルーム')

@section('main')
<chat-room-component
    :user="{{ Auth::user() }}"
    :partner="{{ $partner }}"
    :item="{{ $item }}"
    :room="{{ $room }}"
    :item_tags="{{ ($item_tags) }}"
>
    <template slot="csrf_token">@csrf</template>
</chat-room-component>
@endsection
