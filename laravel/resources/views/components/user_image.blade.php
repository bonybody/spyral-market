<a class="user_image_{{$unique_name}}" href="{{url('home/user/'.$user->id)}}">
    @if(isset($user->user_detail->image))
        <img class="component_user_image_{{$unique_name}}" src="{{asset('storage/users/'.$user->user_detail->image)}}" alt="{{$user->name}}">
    @else
        <img class="component_user_image_{{$unique_name}}" src="{{asset('images/no_user_image.jpg')}}" alt="{{$user->name}}">
    @endif
</a>
<div is="style">

    a.user_image_{{$unique_name}} {
    display: block;
    width: fit-content;
    }

    img.component_user_image_{{$unique_name}} {
    width: {{$width}}px;
    height: {{$height}}px;
    object-fit: cover;
    border-radius: 50%;
    border: 1px solid #000;
    background-color: #000;
    vertical-align: bottom;
    }
</div>
