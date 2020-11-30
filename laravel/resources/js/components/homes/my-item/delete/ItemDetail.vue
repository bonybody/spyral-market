<template>
    <div class="item_detail">
        <a :href="'/home/item/'+item.id">
            <p class="item_name">{{ item.name }}</p>
            <p class="item_image"><img :src="itemImagePath(item)"></p>
        </a>

        <p class="item_price">価格: {{ item.price }}円</p>
            <p class="delete_button" @click="onAlert(item.id)">削除</p>
    </div>
</template>

<script>
    import VuejsDialog from 'vuejs-dialog';
    import VuejsDialogMixin from 'vuejs-dialog/dist/vuejs-dialog-mixin.min.js';
    import 'vuejs-dialog/dist/vuejs-dialog.min.css';

    Vue.use(VuejsDialog);

    export default {
        name: "ItemDetail",
        props: ['item'],
        computed: {
            itemImagePath: function () {
                return function (item) {
                    if (!item.image) {
                        return "/images/no_item_image.jpg";
                    } else {
                        return `/storage/items/${item.image}`;
                    }
                }
            }
        },
        methods: {
            onAlert: function (item_id) {
                var id = item_id;
                this.$dialog
                    .confirm({
                        title: '最終確認',
                        body: '本当に削除してもよろしいですか?' +
                            '<br>' +
                            '削除された商品は復元できません。',
                    }, {
                        html: true,
                        loader: true,
                        okText: 'はい',
                        cancelText: 'キャンセル',
                    })
                    .then(function () {
                        let form = document.createElement('form');
                        form.action = '/home/my_item/push_delete';
                        form.method = 'GET';
                        form.innerHTML = `<input hidden name="id" value="${id}">`;
                        document.body.append(form);
                        form.submit();
                    })
                    .catch(function () {

                    });
            }
        }
    }
</script>

<style scoped>
    .item_detail {
        padding: 0 10px;
        box-sizing: border-box;
    }

    .item_detail a {
        text-decoration: none;
        display: block;
        color: #000;
    }

    .item_name, .item_image, .item_price {
        margin: 20px 0;
    }

    .item_name {
        text-align: center;
    }

    .item_image {
        height: 150px;
        width: 150px;
        margin: 0 auto;
    }

    .item_image img {
        height: 150px;
        width: 150px;
        object-fit: scale-down;
    }

    .delete_button {
        width: fit-content;
        margin: 0 auto 30px auto;
        cursor: pointer;
        border-radius: 100px;
        padding: 5px 20px;
        background-color: blue;
        color: #fff;
        transition: all 0.2s;
    }

    .delete_button:hover {
        opacity: 0.6;
    }
</style>
