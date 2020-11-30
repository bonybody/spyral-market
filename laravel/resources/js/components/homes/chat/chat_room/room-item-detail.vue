<template>
    <div id="room_item_detail">
        <div id="item_label">商品情報</div>
        <div id="item_title">
            {{ item.name }}
        </div>
        <div id="item_image">
            <img :src="itemImagePath(item)" :alt="item.name">
        </div>
        <div id="item_price">
            購入価格: {{ item.price }}円
        </div>
        <div id="item_text" v-if="item.text !== null">
            概要: {{ item.text }}
        </div>
        <div id="item_tags">
            <span>タグ: </span>
            <a
                v-for="(item_tag, index) in item_tags"
                :key="index"
                class="item_tag"
                :href="'/home/search/tag/' + item_tag.tag_id"
            >
                {{item_tag.tag.name}}
            </a>
        </div>
        <div id="item_sbj">
            <span>科目: </span>
            <template
                v-for="(item_tag, index) in item_tags"
            >
            <a
                v-for="(sbj_tag, index) in item_tag.tag.sbj_tag_link"
                v-if="sbj_tag.subject != null"
                :key="index"
                class="item_tag"
                :href="'/home/search/subject/'+sbj_tag.subject.id"
            >
                {{ sbj_tag.subject.name }}
            </a>
            </template>
        </div>
    </div>

</template>

<script>
    export default {
        name: "room-item-detail",
        props: ['item', 'item_tags'],
        computed: {
            itemImagePath: function () {
                self = this;
                return function (item) {
                    if (!item.image) {
                        return "/images/no_item_image.jpg";
                    } else {
                        return `/storage/items/${item.image}`;
                    }
                };
            },
        },

    }
</script>
<style scoped>
    #room_item_detail {
        width: 25%;
        padding: 30px;
        box-sizing: border-box;
    }

    #item_label {
        text-align: center;
        font-size: 2rem;
        margin-bottom: 30px;
    }

    #item_title {
        text-align: center;
        font-size: 1.3rem;
        margin-bottom: 30px;
    }

    #item_image {
        width: 200px;
        height: 200px;
        margin: 0 auto 30px auto;
    }

    #item_image img {
        width: 200px;
        height: 200px;
        object-fit: scale-down;
        vertical-align: bottom;
    }

    #item_price {
        margin-bottom: 30px;
        font-size: 1.4rem;
    }

    #item_text {
        margin-bottom: 30px;
    }

    #item_tags, #item_sbj{
        display: flex;
        flex-wrap: wrap;
        margin-bottom: 20px;
        font-size: 1.2rem;
    }

    #item_tags span, #item_sbj span {
        margin-top: 3px;
    }
    #item_tags a, #item_sbj a {
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
    #item_tags a::before,
    #item_sbj a::before
    {
        background-color: #fff;/*背景色*/
    }
    #item_tags a::before, #item_sbj a::before {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 6px;
        height: 6px;
        content: '';
        border-radius: 10px;
    }
    #item_tags a::after, #item_sbj a::after {
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
    #item_tags a:hover, #item_sbj a:hover {
        color: #ffffff;
        background-color: tomato;
    }
    #item_tags a:hover::after,
    #item_sbj a:hover::after {
        border-left-color: tomato;
    }

    .item_tag {
        display: inline-block;
        margin: 0 10px;
    }



</style>
