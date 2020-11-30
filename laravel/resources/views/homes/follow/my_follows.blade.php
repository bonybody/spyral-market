@extends('layouts.home')

@section('title', 'フォローユーザ一覧')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/homes/follow/my_follows.css') }}">
@endsection

@section('main')
    <div id="my_follows">
        <div id="my_follows_title">
            @component('components.head')
                @slot('title', 'フォローユーザ一覧')
                @slot('caption', 'FOLLOWS')
            @endcomponent
        </div>
        <div id="follow_users_wrap">
            @foreach($users as $user)
                <div class="follow_user">
                    <div class="follow_user_name"><p>{{ $user->name }}</p></div>
                    <div class="follow_user_image">
                        @component('components.user_image')
                            @slot('user', $user)
                            @slot('unique_name', 'follow')
                            @slot('width', 150)
                            @slot('height', 150)
                        @endcomponent
                    </div>
                    <div class="follow_user_school">
                        <p class="label">所属学校 </p>
                        <p>{{ $user->school->name }}</p>
                    </div>
                    <div class="follow_user_course">
                        <p class="label">所属コース </p>
                        <p>{{ $user->course->name }}</p>
                    </div>
                    <div class="follow_user_profile_page">
                        <a href="{{'/home/user/'.$user->id}}">
                            <img src="{{asset('./images/icons/button/profile_button.png')}}">
                            プロフィールへ</a>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

@endsection
