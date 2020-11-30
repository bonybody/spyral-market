@extends('layouts.welcome')

@section('head')
    <script src="{{ asset('js/app.js') }} " defer></script>
    <link rel="stylesheet" href="{{asset('css/welcomes/register.css')}}">
@endsection
@section('main_left')
    <div id="app">
        <form method="POST" action="{{ url('/register') }}">
            <h2>新規登録</h2>
            @csrf

            <div id="school">
                <div class="form_label">
                    <p class="form_label">学校選択</p>
                    @error('school_id')
                    <p class="form_error" style="color: red">{{$message}}</p>
                    @enderror
                </div>
                <p>
                    <select class="form" name="school_id">
                        <option value="">学校を選択してください</option>
                        @foreach($schools as $school)
                            <option value="{{$school->id}}">{{$school->name}}</option>
                        @endforeach
                    </select>
                </p>
            </div>
            {{--            <user-register-component v-bind:hals="{{ json_encode($hals) }}"></user-register-component>--}}
            <div id="course">
                <div class="form_label">
                    <p class="form_label">学科選択</p>
                    @error('course_id')
                    <p class="form_error">{{$message}}</p>
                    @enderror
                </div>
                <p>
                    <select class="form" name="course_id">
                        <option value="">学科を選択してください</option>
                        @foreach($hals as $hal)
                            <option class="form" value="{{$hal->id}}">{{$hal->name}}</option>
                        @endforeach
                        @foreach($modes as $mode)
                            <option class="form" value="{{$mode->id}}">{{$mode->name}}</option>
                        @endforeach
                        @foreach($isens as $isen)
                            <option class="form" value="{{$isen->id}}">{{$isen->name}}</option>
                        @endforeach
                    </select>
                </p>
            </div>

            <div id="name">
                <div class="form_label">
                    <p class="form_label">名前</p>
                    @error('name')
                    <p class="form_error">{{$message}}</p>
                    @enderror
                </div>
                <p><input class="form" type="text" name="name"></p>
            </div>

            <div id="mail">
                <div class="form_label">
                    <p class="form_label">メールアドレス</p>
                    @error('email')
                    <p class="form_error">{{$message}}</p>
                    @enderror
                </div>
                <p><input class="form" type="email" name="email"></p>

            </div>
            <div id="pass">
                <div class="form_label">
                    <p>パスワード</p>
                    @error('password')
                    <p class="form_error">{{$message}}</p>
                    @enderror
                </div>
                <p><input class="form" type="password" name="password"></p>
            </div>

            <input id="submit" class="form" type="submit" value="送信">
        </form>
    </div>
@endsection
