@extends('layouts.welcome')

@section('head')
    <link rel="stylesheet" href="{{asset('css/welcomes/login.css')}}">
@endsection
@section('title', 'ログイン')

@section('main')
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
@endsection
