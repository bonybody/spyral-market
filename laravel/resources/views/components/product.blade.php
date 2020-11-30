<div is="style">
    .item {
    width: 300px;
    padding-bottom: 20px;
    border-radius: 10px;
    box-shadow: black 0 0 3px;
    background-color: rgba(255, 255, 255, 0.9);
    margin: 20px;
    margin-bottom: 50px;
    }

    #product:hover {
    box-shadow: #fff 0 0 3px;
    transition: 0.2s;
    }

    #item_image {
    position: relative;
    width: 300px;
    height: 300px;
    }

    .item_link {
    border-radius: 10px 10px 0 0;
    /*background-color: #1b1e21;*/
    position: relative;
    }

    #item_image a:hover {
    opacity: 0.7;
    }

    img.item_img {
    height: 300px;
    width: 300px;
    object-fit: cover;
    vertical-align: bottom;
    border-radius: 10px 10px 0 0;
    }

    .item_link {

    }

    #item_price {
    background-color: rgba(0, 0, 0, 0.8);
    color: #fff;
    font-size: 1.5rem;
    border-radius: 0 30px 30px 0;
    padding: 3px 10px 3px 3px;
    position: absolute;
    bottom: 20px;
    left: 0;
    }

    div.seller_image {
    position: absolute;
    bottom: 20px;
    right: 10px;
    opacity: 1;
    }


    #item_title {
    margin: 10px 10px 20px 10px;
    }

    #item_title a {
    font-size: 1.3rem;
    /*font-weight: bold;*/
    font-family: 'Kosugi Maru', sans-serif;
    color: black;
    text-decoration: none;
    }

    .component_product_tag, .component_product_sbj {
    line-height: 26px;
    position: relative;
    display: inline-block;
    height: 26px;
    margin-bottom: 10px;
    margin-right: 10px;
    padding: 0 20px 0 23px;
    -webkit-transition: color 0.2s;
    transition: color 0.2s;
    text-decoration: none;
    color: #455a64;
    border-radius: 3px 0 0 3px;
    background: #cfd8dc;
    }
    .component_product_tag::before, .component_product_tag::after,
    .component_product_sbj::before, .component_product_sbj::after
    {
    background: #fafcfc;/*背景色*/
    }
    .component_product_tag::before, .component_product_sbj::before {
    position: absolute;
    top: 10px;
    left: 10px;
    width: 6px;
    height: 6px;
    content: '';
    border-radius: 10px;
    }
    .component_product_tag::after, .component_product_sbj::after {
    position: absolute;
    top: -2px;
    right: -6px;
    width: 0;
    height: 0;
    content: '';
    border-width: 15px 0 15px 8px;
    border-style: solid;
    border-color: transparent transparent transparent #cfd8dc;
    border-radius: 4px;
    }
    .component_product_tag:hover, .component_product_sbj:hover {
    color: #ffffff;
    background-color: tomato;
    }
    .component_product_tag:hover::after,
    .component_product_sbj:hover::after
    {
    border-left-color: tomato;
    }

    .component_product_tags, .component_product_sbjs {
    margin-top: 20px;
    }

    #tags_wrap, #subjects_wrap {
    float: left;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    width: 250px
    }

    .component_product_tags span, .component_product_sbjs span {
    margin-top: 3px;
    margin-right: 5px;
    margin-left: 5px;
    float: left;
    }


</div>

<div class="item">
    <div id="item_image">
        @if($item->status == 'trade')
            <p class="item_status">取引中</p>
            <div is="style">
                .item_status {
                position: absolute;
                padding: 10px 0;
                width: 300px;
                color: #fff;
                background-color: red;
                font-size: 3rem;
                top: 150px;
                left: 0;
                right: 0;
                margin-right: auto;
                margin-left: auto;
                text-align: center;
                z-index: 3;
                }

            </div>
        @endif
        @if($item->status == 'sold')
            <p class="item_status">売り切れ</p>
            <div is="style">
                .item_status {
                position: absolute;
                padding: 10px 0;
                width: 300px;
                color: #fff;
                background-color: red;
                font-size: 3rem;
                top: 150px;
                left: 0;
                right: 0;
                margin-right: auto;
                margin-left: auto;
                text-align: center;
                z-index: 3;
                }

            </div>
        @endif

        <a class="item_link" href="{{url('/home/item/'.$item->id)}}">
            @if(!empty($item->image))
                <img class="item_img" src="{{asset('storage/items/' . $item->image)}}" alt="{{$item->name}}">
            @else
                <img class="item_img" src="{{asset('images/no_item_image.jpg')}}" alt="">
            @endif
            <span id="item_price">{{$item->price}}円</span>
        </a>
        <div class="seller_image">
            @component('components.user_image')
                @slot('unique_name', 'product')
                @slot('user', $item->user)
                @slot('width', 50)
                @slot('height', 50)
            @endcomponent
        </div>
    </div>
    <p id="item_title">
        <a href="{{url('/home/item/'.$item->id)}}">{{$item->name}}</a>
    </p>
    @if(count($item->item_tags) > 0)
        <div class="component_product_tags clearfix">
            <span>タグ:</span>
            <div id="tags_wrap">
                @foreach($item->item_tags as $tags)
                    <a class="component_product_tag"
                       href="{{url('/home/search/tag/' . $tags->tag->id)}}">{{$tags->tag->name}}</a>
                    @php
                        if (count($tags->tag->sbj_tag_link) > 0) {
                                $r_tags[] = $tags->Tag;
                        }
                    @endphp
                @endforeach
            </div>
        </div>
        @isset($r_tags)
            <div class="component_product_sbjs clearfix">
                <span>科目:</span>
                <div id="subjects_wrap">
                    @foreach($r_tags as $r_tag)
                        @foreach($r_tag->Sbj_tag_link as $sbj_link)
                            <a class="component_product_sbj"
                               href="{{url('/home/search/subject/' . $sbj_link->Subject->id)}}">{{$sbj_link->Subject->name}}</a>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endisset
    @endif
</div>
