@extends('layouts.welcome')

@section('head')
{{--    <script src="{{ asset('js/components/welcomes/userLogin.vue') }}" defer></script>--}}

    <script src="{{ asset('js/app.js') }} " defer></script>
{{--    <script src="{{ asset('js/components/welcomes/userLogin.vue') }}" defer></script>--}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
@section('main')
    <form method="POST" action="{{ url('/register') }}">
        @csrf
        <div id="app">
            <select name="school">
                @foreach($schools as $school)
                    <option value="{{$school->id}}">{{$school->name}}</option>
                @endforeach
            </select>
            {{var_dump(json_encode($hals))}}
            <user-login-component hals: {{json_encode($hals)}} ></user-login-component>
            <button>Submit!</button>
        </div>
    </form>

@endsection
