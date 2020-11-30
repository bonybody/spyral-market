<!doctype html>
<html lang=ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Anton|M+PLUS+Rounded+1c|Noto+Sans+JP&display=swap"
          rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Kosugi|Kosugi+Maru|M+PLUS+1p|M+PLUS+Rounded+1c|Noto+Sans+JP|Noto+Serif+JP|Roboto|Sawarabi+Gothic|Sawarabi+Mincho&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/layouts/welcomes.css')}}">
    @yield('head')
    <title>@yield('title')</title>
</head>
<body>
<div id="wrap">
    <section class="main">
        <div id="main_left">
            <div id="login_or_register">
                <div id="sign_up" class="menu_button"><a href="{{'/register'}}"><img
                            src="{{asset('images/icons/button/regiser_button.png')}}">新規登録</a></div>
                <div id="login" class="menu_button"><a href="{{'/'}}"><img
                            src="{{asset('images/icons/button/login_button.png')}}" alt="">ログイン</a></div>
            </div>
        </div>
        <div id="main_right">
            @section('main_left')
                <div id="box">
                    <form method="POST" action="{{ url('/login') }}">
                        <h2>ログイン</h2>
                        @csrf

                        <div id="mail">
                            <p>メールアドレス</p>
                            <p><input class="form" type="email" name="email" value="{{old('email')}}"></p>
                            @error('email')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>

                        <div id="pass">
                            <p>パスワード</p>
                            <p><input class="form" type="password" name="password" {{old('password')}}></p>
                            @error('password')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>

                        <input id="submit" class="form" type="submit" value="送信">
                    </form>
                </div>
            @show
        </div>
    </section>

</div>

</body>
</html>
