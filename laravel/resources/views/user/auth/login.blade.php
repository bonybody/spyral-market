@extends('user.layout.auth')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/login') }}">
        @csrf
        <select name="school_id">
            @foreach($schools as $school)
                <option value="{{$school->id}}">{{$school->name}}</option>
            @endforeach
        </select>
    </form>


{{--        <div class="form-group">--}}
{{--            <div class="col-md-8 col-md-offset-4">--}}
{{--                <button type="submit" class="btn btn-primary">--}}
{{--                    Login--}}
{{--                </button>--}}

{{--                <a class="btn btn-link" href="{{ url('/user/password/reset') }}">--}}
{{--                    Forgot Your Password?--}}
{{--                </a>--}}
@endsection
