<template>
    <div class="chat_rooms">

        <div v-if="buyer_rooms[0] != null">
            <div class="room_head"><p>購入商品のチャットルーム</p></div>
            <div class="buyer_room room" v-for="(buyer_room, index) in buyer_rooms" :key="index">
                <a :href="'/home/chat/room/' + buyer_room.id + '/buyer'">
                <div class="room_detail">
                    <p class="item_image"><img :src="itemImagePath(buyer_room.item)" :alt="buyer_room.item.name">
                    </p>
                    <div class="room_detail_text">
                        <p class="room_title">{{ buyer_room.item.name}}</p>
                        <p class="room_member">{{ buyer_room.buyer.name }}, {{ buyer_room.seller.name }}</p>
                    </div>
                </div>
                <hr>
                </a>
            </div>
        </div>

        <div v-if="seller_rooms[0] != null">
            <div class="room_head"><p>出品商品のチャットルーム</p></div>
            <div class="seller_room room" v-for="(seller_room, index) in seller_rooms" :key="index">
                <a :href="'/home/chat/room/' + seller_room.id + '/seller'">
                    <div class="room_detail">
                        <p class="item_image"><img :src="itemImagePath(seller_room.item)" :alt="seller_room.item.name">
                        </p>
                        <div class="room_detail_text">
                            <p class="room_title">{{ seller_room.item.name}}</p>
                            <p class="room_member">{{ seller_room.seller.name }}, {{ seller_room.buyer.name }}</p>
                        </div>
                    </div>
                    <hr>
                    <p>最新メッセージ</p>
                </a>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        name: "chat",
        props: {
            buyer_rooms: {
                default: false,
            },
            seller_rooms: {
                default: false,
            },
        },
        data: function () {
            return {}
        },
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
            }
        }

    }
</script>

<style scoped>
    .chat_rooms {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-around;
    }
    .room_head {
        font-size: 3rem;
        text-align: center;
    }
    form button {

    }

    .room {
        width: 500px;
        padding: 10px;
        box-shadow: rgba(0, 0, 0, 0.4) 0 0 10px;
        margin: 50px auto;
        border-radius: 10px;
    }
    .room:hover {
        transform: scale(1.2) translate(-5px, 0);
        transition: 0.3s;
    }

    .room a {
        text-decoration: none;
        color: #000;
    }

    .item_image {
        margin-right: 10px;
    }

    .item_image img {
        hetght: 500px;
        width: 50px;
        object-fit: cover;
        vertical-align: bottom;
    }

    .room_detail {
        display: flex;
        flex-wrap: wrap;
        align-items: center;

        font-size: 1.2rem;
        vertical-align: top;
    }

    .room_detail_text p {
        margin: 10px;
    }

</style>
