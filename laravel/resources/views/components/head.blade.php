<div is="style">
    .head {
        width: 600px;
        margin: 30px auto;
        padding: 5px 0;
        font-family: sans-serif;
        font-size: 30px;
        color: tomato;
    }

    .heading {
        margin: 10px 0
    }

    .head .heading {
        position: relative;
        height: 70px;
        padding: 0;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        border: 1px solid tomato;
        line-height: 70px;
        background: #fff;
    }

    .head .heading .caption {
        position: absolute;
        right: 0;
        top: 0;
        padding-left: 25px;
        padding-right: 45px;
        background: tomato;
        color: #fff;
        border-radius: 0 8px 10px 0;
    }

    .head .heading .caption:before {
        display: block;
        content: ' ';
        width: 0;
        height: 0;
        overflow: hidden;
        position: absolute;
        right: 99.9%;
        top: 0;
        border: 0 solid transparent;
        border-width: 70px 74px 0 0;
        border-right-color: tomato;
    }

    .head .heading .title {
        font-weight: bold;
        float: left;
        padding-left: 20px;
    }
</div>

<div class="head">
    <div class="heading">
        <span class="title">{{$title}}</span>
        <span class="caption">{{$caption}}</span>
    </div>
</div>
