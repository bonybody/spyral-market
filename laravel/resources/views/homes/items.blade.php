@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="{{asset('css/homes/items.css')}}">
@endsection

@section('title', '商品')

@section('main')

    <div class="item">
        <div class="item_image">
            @if($item->status == 'trade')
                <p class="item_status">取引中</p>
                <div is="style">
                    .item_status {
                    position: absolute;
                    height: 4rem;
                    width: 500px;
                    background-color: rgba(255, 255, 255, 0.7);
                    font-size: 3rem;
                    top: 0;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    margin: auto;
                    text-align: center;
                    z-index: 3;
                    }
                    .item_image img {
                    opacity: 0.7;
                    }

                </div>
            @endif
            @if($item->status == 'sold')
                <p class="'item_status">売り切れ</p>
                <div is="style">
                    .item_status {
                    position: absolute;
                    height: 4rem;
                    width: 500px;
                    background-color: rgba(255, 255, 255, 0.7);
                    font-size: 3rem;
                    top: 0;
                    bottom: 0
                    left: 0;
                    right: 0;
                    margin: auto;
                    text-align: center;
                    z-index: 3;
                    }
                    .item_image img {
                    opacity: 0.7;
                    }

                </div>

            @endif

        @if(isset($item->image))
                <img src="{{asset('storage/items/'.$item->image)}}" alt="{{$item->name}}">
            @else
                <img src="{{asset('images/no_item_image.jpg')}}" alt="画像はありません">
            @endif
        </div>
        <div class="item_details">
            <p class="item_name">{{$item->name}}</p>
            <p class="item_price">￥{{$item->price}}円</p>

            <div class="item_text">
                <div class="item_head">
                    <div class="heading"><span>概要文</span></div>
                </div>
                <p class="text">{{$item->text}}</p>
            </div>
            @isset($item->item_tags)
                <div class="tags">
                    <span>タグ:</span>
                    @foreach($item->item_tags as $item_tag)
                        <a class="tag" href="{{url('/home/search/tag/' . $item_tag->tag->id)}}">{{$item_tag->tag->name}}</a>
                        @php
                            $r_tags[] = $item_tag->Tag;
                        @endphp
                    @endforeach
                </div>
                @isset($r_tags)
                    <div class="sbjs">
                        <span>科目:</span>
                        @foreach($r_tags as $r_tag)
                            @foreach($r_tag->Sbj_tag_link as $sbj_link)
                                <a class="sbj"
                                   href="{{url('/home/search/subject/' . $sbj_link->Subject->id)}}">{{$sbj_link->Subject->name}}</a>
                            @endforeach
                        @endforeach
                    </div>
                @endisset
            @endisset
            <div class="seller_info">
                @component('components.user_image')
                    @slot('unique_name', 'items')
                    @slot('width', 50)
                    @slot('height', 50)
                    @slot('user', $item->user)
                @endcomponent
                <p class="seller_name"><a href="{{ url('/home/user/'.$item->user->id) }}">{{$item->user->name}}</a></p>
            </div>
            <form class="buy" action="{{url('/home/item/buy')}}" method="post" name="buy_item">
                @csrf
                <input type="hidden" name="item_id" value="{{$item->id}}">
                <input type="hidden" name="buyer_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="seller_id" value="{{$item->seller_id}}">
                <buy-item-check-component :buy_possible_check="{{json_encode($buy_possible_check)}}"></buy-item-check-component>
            </form>
        </div>
    </div>
    {{--    <div class="comment">--}}
    {{--    </div>--}}
@endsection
