@extends('layouts.welcome')

@section('head')
    <link rel="stylesheet" href="{{asset('css/welcomes/welcome.css')}}">
@endsection

@section('title', 'ログイン')
@section('main_left')
    @parent
@endsection

