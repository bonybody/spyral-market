<template>
    <button type="button" class="item_submit" @click="onAlert()">投稿！</button>
</template>

<script>
    import VuejsDialog from 'vuejs-dialog';
    import VuejsDialogMixin from 'vuejs-dialog/dist/vuejs-dialog-mixin.min.js';
    import 'vuejs-dialog/dist/vuejs-dialog.min.css';

    Vue.use(VuejsDialog);

    export default {
        name: "put_up_check_dialog",
        methods: {
            onAlert: function () {
                this.$dialog
                    .confirm({
                        title: '最終確認',
                        body: '投稿してもよろしいですか？'
                    }, {
                        loader: true,
                        okText: 'はい',
                        cancelText: 'キャンセル',
                    })
                    .then(function () {
                        document.put_up.submit();
                    })
                    .catch(function () {

                    });
            },
        },
    }


</script>

<style scoped>
    .item_submit {
        margin: 100px 0;
        font-size: 2rem;
        font-family: 'Kosugi Maru', sans-serif;
        padding: 20px 50px;
        border: 3px solid tomato;
        background-color: #fff;
        color: tomato;
    }

    .item_submit:hover {
        color: #fff;
        background-color: tomato;
        transition: 0.3s;
    }

    .item_submit:focus {
        color: #fff;
        background-color: tomato;
        outline: none;
    }

    .item_tag_component {
        width: 500px;
    }
    .multiselect__option--highlight {
        background: tomato;
    }
    .multiselect__option--highlight:after {
        background: tomato;
    }
    .multiselect__tag {
        background-color: tomato;
    }
    .multiselect__tag-icon:after {
        background-color: rgba(235, 79, 51);
        box-shadow: rgb(235, 79, 51) 0 0 10px;
    }
    .multiselect__spinner:before,
    .multiselect__spinner:after {
        border-color: rgb(235, 79, 51);
    }


</style>
