<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/layouts/homes.css')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Kosugi|Kosugi+Maru|M+PLUS+1p|M+PLUS+Rounded+1c|Noto+Sans+JP|Noto+Serif+JP|Roboto|Sawarabi+Gothic|Sawarabi+Mincho&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kosugi+Maru&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    @yield('head')
    <title>@yield('title')</title>
</head>
<body>
<div id="app">
    <div id="wrap">
        <header>
            <div id="header_right">
                <h1 id="title_logo"><a href="{{url('/home')}}">SPYRAL MARKET</a></h1>
                <form id="key_search" action="{{url('/home/search/keyword')}}" method="get">
                    <home-categories-component v-bind:categories="{{ ($categories) }}"
                                               v-bind:sub_categories="{{($sub_categories)}}"></home-categories-component>
                    <input type="text" name="keyword" id="key_word" placeholder="キーワードで検索">
                    <button type="submit" id="key_submit">検索</button>
                </form>
            </div>
            <div id="header_left">
                <div id="user">
                    @component('components.user_image')
                        @slot('unique_name', 'home')
                        @slot('user', Auth::user())
                        @slot('height', 50)
                        @slot('width', 50)
                    @endcomponent
                    <p id="user_name"><a
                            href="{{url(('/home/user/'.Auth::user()->id))}}">{{Auth::user()->name}}</a>
                    </p>
                </div>
                <p id="logout"><a href="{{url('/logout')}}">ログアウト</a></p>
            </div>
        </header>
        <nav id="header_nav">
            <a href="{{url('/home/my_item')}}"><img src="{{asset('images/icons/header_nav/items_ctrl.png')}}">
                <p>商品管理</p></a>
            @if( request()->is('*my_item*'))
                <div is="style">
                    #header_nav a:nth-child(1)::after {
                    width: 100%;
                    background-color: white;
                    bottom: 0;
                    content: '';
                    display: block;
                    height: 3px;
                    left: 8px;
                    position: absolute;
                    transition: .3s all cubic-bezier(0.860, 0.000, 0.070, 1.000);
                    }

                </div>
            @endif

            <a href="{{url('/home/chat')}}"><img src="{{asset('images/icons/header_nav/chat.png')}}">
                <p>取引メッセージ</p></a>
            @if( request()->is('*chat*'))
                <div is="style">
                    #header_nav a:nth-child(2)::after {
                    width: 100%;
                    background-color: white;
                    bottom: 0;
                    content: '';
                    display: block;
                    height: 3px;
                    left: 8px;
                    position: absolute;
                    transition: .3s all cubic-bezier(0.860, 0.000, 0.070, 1.000);
                    }

                </div>
            @endif

            <a href="{{url('/home/user/'.Auth::user()->id)}}"><img src="{{asset('images/icons/header_nav/profile.png')}}">
                <p>マイページ</p></a>
            @if( request()->is('*user*') and request()->is('*'. Auth::user()->id .'*'))
                <div is="style">
                    #header_nav a:nth-child(3)::after {
                    width: 100%;
                    background-color: white;
                    bottom: 0;
                    content: '';
                    display: block;
                    height: 3px;
                    left: 8px;
                    position: absolute;
                    transition: .3s all cubic-bezier(0.860, 0.000, 0.070, 1.000);
                    }

                </div>
            @endif

            <a href="{{url('/home/put_up')}}"><img src="{{asset('images/icons/header_nav/put_up.png')}}">
                <p>出品！</p></a>
            @if( request()->is('*put_up*'))
                <div is="style">
                    #header_nav a:nth-child(4)::after {
                    width: 100%;
                    background-color: white;
                    bottom: 0;
                    content: '';
                    display: block;
                    height: 3px;
                    left: 8px;
                    position: absolute;
                    transition: .3s all cubic-bezier(0.860, 0.000, 0.070, 1.000);
                    }

                </div>
            @endif

        </nav>

        <div class="box">
            <nav id="side_nav">
                <div class="side_item" id="search">
                    <h2 class="side_title">サイドメニュー</h2>
                    <hr>
                    <ul>
                        <li><a href="{{url('/home/search/new')}}">
                                <img src="{{ asset('images/icons/side_nav/new.png') }}">
                                新着商品</a></li>
                        <li><a href="{{url('/home/follow')}}">
                                <img src="{{asset('images/icons/side_nav/follows.png')}}" alt="">
                                フォローユーザ
                            </a></li>
                        <li><a href="{{url('/home/follow/item')}}">
                                <img src="{{asset('images/icons/side_nav/follow.png')}}">
                                フォローユーザ<br>　 の出品</a></li>
                        <li><a href="{{url('/home/item/buy_history')}}">
                                <img src="{{asset('images/icons/side_nav/history.png')}}">
                                購入履歴</a></li>
                    </ul>
                </div>
            </nav>
            <main>
                @yield('main')
            </main>
        </div>
    </div>
</div>
{{--<script src="{{asset("js/components/homes/homes.vue")}}" defer></script>--}}
<script src="{{mix("js/app.js")}}"></script>
</body>
</html>
