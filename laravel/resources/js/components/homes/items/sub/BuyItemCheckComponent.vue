<template>
    <button
        type="button"
        class="buy_button"
        @click="onAlert()"
        :style="button_state"
    >購入
    </button>
</template>

<script>
    import VuejsDialog from 'vuejs-dialog';
    import VuejsDialogMixin from 'vuejs-dialog/dist/vuejs-dialog-mixin.min.js';
    import 'vuejs-dialog/dist/vuejs-dialog.min.css';

    Vue.use(VuejsDialog);

    export default {
        name: "BuyItemCheckComponent",
        props: {
            buy_possible_check: {
                default: false
            }
        },
        methods: {
            onAlert: function () {
                this.$dialog
                    .confirm({
                        title: '最終確認',
                        body: '本当に購入しますか？'
                    }, {
                        loader: true,
                        okText: 'はい',
                        cancelText: 'キャンセル',
                    })
                    .then(function () {
                        document.buy_item.submit();
                    })
                    .catch(function () {

                    });
            },
        },
        computed: {
            button_state: function () {
                if (JSON.parse(this.buy_possible_check)) {
                    return {
                        pointerEvents: "auto",
                    }
                } else {
                    return {
                        pointerEvents: "none",
                        opacity: "0.5",
                    }
                }
            }
        }
    }

</script>

<style scoped>

</style>
