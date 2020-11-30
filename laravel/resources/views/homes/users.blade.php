@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="{{asset('css/homes/users.css')}}">
@endsection

@section('title', 'プロフィール')

@section('main')

    @component('components.head')
        @slot('title', 'プロフィール')
        @slot('caption', 'PROFILE')
    @endcomponent

    <div class="profile">

        @switch(Auth::user()->school_id)
            @case(1)
            <img class="school" src="{{asset('images/profile_home/hal.jpg')}}" alt="hal">
            @break
            @case(2)
            <img class="school" src="{{asset('images/profile_home/mode.jpg')}}" alt="mode">
            @break
            @case(3)
            <img class="school" src="{{asset('images/profile_home/isen.jpg')}}" alt="">
            @break
        @endswitch

        <div class="user_course"><p>{{$user->course->name}}</p></div>

        <div class="profile_image">
            @component('components.user_image')
                @slot('unique_name', 'users')
                @slot('user', $user)
                @slot('width', 250)
                @slot('height', 250)
            @endcomponent
            <p class="user_name">
                <span class="name">{{$user->name}}</span>
            </p>
        </div>

        @if(Auth::user()->id === $user->id)
            <a class="edit" href="{{url('/home/user/edit/'.Auth::user()->id)}}">変更<img class="edit_icon"
                                                                                       src="{{asset('images/profile_icons/edit.png')}}"
                                                                                       alt="edit"></a>
        @elseif(!empty($follow[0]))
            <form method="post" action="{{ url('/home/user/unfollow') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="submit" class="follow" value="フォロー解除">
            </form>
                <div is="style">
                    .follow {
                    background-color: blue;
                    box-shadow: #fff 0 0 10px;

                    }
                    .follow:hover {
                    background-color: skyblue;
                    }

                </div>
            @else
            <form method="post" action="{{url('/home/user/follow')}}">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="submit" class="follow" value="フォロー">
            </form>
            <div is="style">
                .follow {
                    background-color: blue;
                    box-shadow: #fff 0 0 10px;
                }
                .follow:hover {
                background-color: skyblue;
                }
            </div>
        @endif
        <h4>
            <div>受講科目</div>
        </h4>
        <div class="subject">
            @if(count($user->taken_subjects) != 0)
                @foreach($user->taken_subjects as $taken_subject)
                    <p class="subject_item"><a class="subject_link"
                                               href="{{url('home/search/subject/'.$taken_subject->subject_id)}}">{{$taken_subject->subject->name}}</a>
                    </p>
                @endforeach
            @else
                <span class="profile_text">登録科目無し</span>
            @endif
        </div>
        <h4>
            <div>コメント</div>
        </h4>
        <div class="message">
            @if(isset($user->user_detail->message))
                <span class="profile_text">{{$user->user_detail->message}}</span>
            @else
                <span class="profile_text">コメント無し</span>
            @endif
        </div>
        <h4>
            <div>この人の商品</div>
        </h4>
        <div class="product">
            @if(count($user->items) != 0)
                @foreach($user->items()->paginate(6) as $item)
                    @component('components.product')
                        @slot('item', $item)
                    @endcomponent
                @endforeach
            @endif
        </div>
        <div class="paginate_link">{{$user->items()->paginate(6)->appends(['id'=>$user->id])->links()}}</div>
    </div>
@endsection
