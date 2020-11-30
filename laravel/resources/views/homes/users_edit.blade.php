@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="{{asset('css/homes/users_edit.css')}}">
@endsection

@section('title', 'プロフィール変更')

@section('main')

    @component('components.head')
        @slot('title', 'プロフィール変更')
        @slot('caption', 'PROFILE EDIT')
    @endcomponent

    <div class="profile_edit">
        <form action="{{url('home/user/edit')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$user->id}}">
            @csrf

            <div class="form_box">

                <div class="image">
                    @component('components.users_edit_head')
                        @slot('head', 'プロフィール画像')
                    @endcomponent
                    <div class="image_main">
                        <div class="now_image">
                            <p class="now_image_label">現在の画像</p>
                            @component('components.user_image')
                                @slot('unique_name', 'users_edit')
                                @slot('user', $user)
                                @slot('width', 200)
                                @slot('height', 200)
                            @endcomponent
                        </div>
                        @component('components.file_upload_button')@endcomponent
                    </div>
                </div>


                <div class="name">
                    @component('components.users_edit_head')
                        @slot('head', '名前')
                    @endcomponent

                    <div class="form_main">
                        @error('name')
                        <p class="form_error">{{$message}}</p>
                        @enderror
                        <input class="input_name" type="text" name="name" size="8"
                               value="{{Auth::user()->name}}">
                        <p class="comment">(8文字以下)</p>
                    </div>
                </div>


                <div class="subject">
                    @component('components.users_edit_head')
                        @slot('head', '科目')
                    @endcomponent

                    <div class="form_main">
                        @error('subject')
                        <p class="form_error">{{$message}}</p>
                        @enderror
                        @foreach($subject_relations as $subject_relation)
                            <div class="row">
                                <input id="subject_check{{$subject_relation->subject->id}}" type="checkbox"
                                       name="subject[]"
                                       value="{{$subject_relation->subject->id}}"
                                       @if(in_array($subject_relation->subject->id, $my_subjects))
                                       checked
                                    @endif
                                >

                                <label class="check_label"
                                       for="subject_check{{$subject_relation->subject->id}}">{{$subject_relation->subject->name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="message">
                    @component('components.users_edit_head')
                        @slot('head', 'コメント')
                    @endcomponent

                    <div class="form_main">
                        @error('message')
                        <p class="form_error">{{$message}}</p>
                        @enderror
                        <textarea name="message" cols="60"
                                  rows="20">@isset($user->user_detail->message){{$user->user_detail->message}}@endisset</textarea>
                    </div>
                </div>
            </div>
            <div class="submit">
                <input type="submit">
            </div>
        </form>
    </div>

@endsection
