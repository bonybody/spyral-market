<template>
    <div id="options_wrap">
        <a href="/home/my_item/delete" id="delete" class="options">
            <div class="option_name"><p>削除</p></div>
            <div class="option_icon"><img src="/images/icons/my-item-index/delete.png" alt="delete"></div>
            <div class="option_text"><p>自分の投稿した商品を削除できます</p></div>
        </a>
    </div>
</template>

<script>

    export default {
        name: "my-item-index",
        props: ['items'],
    }
</script>

<style scoped>

    #options_wrap {
        display: flex;
        justify-content: space-around;
        min-height: 500px;
    }
    .options {
        box-shadow: rgba(0, 0, 0, 0.5) 0 0 10px;
        border-radius: 10px;
        height: 300px;
        width: 200px;
        display: block;
        text-decoration: none;
        color: #000;
        transition: all 0.2s ease-in-out;
    }
    .options:hover {
        transform: translateY(-10px);
        opacity: 0.7;
    }
    .option_name {
        text-align: center;
        font-size: 2rem;
        margin: 20px 0;
    }

    .option_icon {
        text-align: center;
    }
    .option_icon img{
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin-bottom: 20px;
    }
    .option_text {
        width: 170px;
        margin: 0 auto;
    }

</style>
