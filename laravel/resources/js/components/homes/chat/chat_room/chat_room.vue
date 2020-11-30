<template>
    <div id="chta_room_wrap">
        <room-item-detail
            :item="item"
            :item_tags="item_tags"
        ></room-item-detail>
        <div id="bms_container">
            <form action="/home/chat/room/complete_check" method="post" name="complete_check">
                <slot name="csrf_token"></slot>
                <input type="hidden" name="sender_id" :value="user.id">
                <input type="hidden" name="room_id" :value="room.id">
                <input type="hidden" name="item_id" :value="item.id">
            </form>
            <button id="complete_button" @click="onAlert">{{ complete }}</button>
            <div id="bms_messages_container">
                <!-- ヘッダー部分② -->
                <div id="bms_chat_header">
                    <!--ステータス-->
                    <div id="bms_chat_user_status">
                        <!--ステータスアイコン-->
                        <div id="bms_status_icon">●</div>
                        <!--ユーザー名-->
                        <div id="bms_chat_user_name">{{ item.name }}</div>
                    </div>
                </div>
                <!-- タイムライン部分③ -->
                <div id="bms_messages">
                    <!--メッセージ１（左側）-->
                    <div
                        class="bms_clear bms_message"
                        :class="{bms_left: message.sender_id == partner.id, bms_right: message.sender_id == user.id}"
                        v-for="message in messages">
                        <div class="bms_message_box">
                            <div class="bms_message_content">
                                <div class="bms_message_text">{{ message.text }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->

                    <!--メッセージ２（右側）-->
                </div>

                <!-- テキストボックス、送信ボタン④ -->
                <div id="bms_send">
                    <textarea id="bms_send_message" v-model="newMessage"></textarea>

                    <div id="bms_send_btn" @click="addMessage">
                        送信
                    </div>
                </div>
            </div>
        </div>
        <room-partner-detail
            :partner="partner"
        ></room-partner-detail>
    </div>
</template>

<script>

    import RoomItemDetail from "./room-item-detail";
    import RoomPartnerDetail from "./room-partner-detail";
    import VuejsDialog from 'vuejs-dialog';
    import VuejsDialogMixin from 'vuejs-dialog/dist/vuejs-dialog-mixin.min.js';
    import 'vuejs-dialog/dist/vuejs-dialog.min.css';

    Vue.use(VuejsDialog);
    export default {
        components: {RoomPartnerDetail, RoomItemDetail},
        props: {
            user: {
                default: null
            },
            partner: {
                default: null
            },
            item: {
                default: null
            },
            item_tags: {
                default: null
            },
            room: {
                default: null
            },
        },
        data: function () {
            return {
                messages: [],
                newMessage: '',
            }
        },
        mounted() {
            let params = new URLSearchParams();
            params.append('room_id', this.room.id);
            axios.post('/api/messages', params).then(response =>
                (this.messages = response.data)
            );

            window.Echo.private('message-added-channel.' + this.room.id)
                .listen('MessageAdded', response => {
                    this.messages.push(response.data);
                    this.scrollToEnd();
                });
        },
        updated() {
            this.scrollToEnd();
        },

        computed: {
            complete() {
                var message;
                if (
                    (this.user.id == this.room.buyer_id && this.room.buyer_check == 0) ||
                    (this.user.id == this.room.seller_id && this.room.seller_check == 0)) {
                    message = "取引完了";
                } else {
                    message = "取引完了キャンセル";
                }
                return message +=  (this.room.buyer_check - 0) + (this.room.seller_check - 0) + '/2';
            }
        },

        methods: {
            addMessage() {
                if (this.newMessage != false) {
                    let params = new URLSearchParams();
                    params.append('sender_id', this.user.id);
                    params.append('text', this.newMessage);
                    params.append('room_id', this.room.id);
                    this.newMessage = '';
                    axios.post('/api/send_message', params)
                        .then(response => {
                            this.messages.push(response.data);
                            this.applyMessage(response.data);
                            this.scrollToEnd();
                        });
                }
            },
            applyMessage(message) {
                let params = new URLSearchParams();
                params.append('room_id', message.room_id);
                params.append('sender_id', message.sender_id);
                params.append('text', message.text);
                axios.post('/api/apply_message', params)
                    .then(response => {
                        console.log(response.data);
                    });
                this.scrollToEnd();
            },
            scrollToEnd: function () {
                let container = this.$el.querySelector("#bms_messages");
                container.scrollTop = container.scrollHeight - 100;
            },
            onAlert: function () {
                this.$dialog
                    .confirm({
                        title: '取引完了！',
                        body: '商品の受け渡し等はお済みですか?' +
                            '<br>' +
                            'チェックが2/2になった時点で取引完了とみなされチャットルームは' +
                            '<span style="color: red">閉鎖</span>されます。'
                    }, {
                        html: true,
                        loader: true,
                        okText: 'はい',
                        cancelText: 'キャンセル',
                    })
                    .then(function () {
                        document.complete_check.submit();
                    })
                    .catch(function () {

                    });
            },
        },

    }
</script>

<style scoped>

    #chta_room_wrap {
        display: flex;
        justify-content: space-around;
    }

    #bms_container {
        /* 高さや幅など、好きな様に設定
        bms_messages_containerの方で、縦横いっぱいに広がってくれるので、
        ここで充てた高さと横幅がそのままスタイルになる仕組み */
        position: relative;

        height: calc(100vh - 145px);

        width: 75%; /*ここはご自由に*/
    }

    #complete_button {
        position: absolute;
        top: 60px;
        left: 0;
        right: 0;
        margin: auto;
        background-color: blue;
        color: #fff;
        font-size: 1.5rem;
        padding: 10px 20px;
        font-family: 'Kosugi Maru', sans-serif;
        border: none;
        border-radius: 100px;
        box-shadow: skyblue 0 0 5px;
        transition: all 0.3s;

    }
    #complete_button:hover {
        box-shadow: blue 0 0 10px;
        transform: translateY(10px);
    }

    #bms_messages_container {
        height: 100%;
        width: 100%; /*your_containerに対して100%になる */
        background-color: #eee;
    }

    /* ヘッダー部分② */
    #bms_chat_header {
        padding: 5px; /*隙間調整*/
        font-size: 16px;
        height: 35px;
        background: #ddd;
    }

    /* ステータスマークとユーザー名 */
    #bms_chat_user_status {
        float: left; /* bms_chat_headerに対して左寄せ */
    }

    /* ステータスマーク */
    #bms_status_icon {
        float: left; /* bms_chat_user_statusに対して左寄せ */
        line-height: 2em; /*高さ調整*/
    }

    /* ユーザー名 */
    #bms_chat_user_name {
        float: left; /* bms_chat_user_statusに対して左寄せ */
        line-height: 2em; /*高さ調整*/
        padding-left: 8px;
    }

    /* タイムライン部分③ */
    #bms_messages {
        overflow: auto; /* スクロールを効かせつつ、メッセージがタイムラインの外に出ないようにする */
        height: calc(100% - 105px);
        padding-top: 50px;
        box-sizing: border-box;
        /*テキストエリアが下に張り付く様にする*/
        border-right: 1px solid #ddd;
        border-left: 1px solid #ddd;
        background-color: #eee;
        box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.2) inset; /*ヘッダーの下に影を入れる*/
    }

    /* メッセージ全般のスタイル */
    .bms_message {
        margin: 0px;
        padding: 0 14px; /*吹き出しがタイムラインの側面にひっつかない様に隙間を開ける*/
        font-size: 16px;
        word-wrap: break-word; /* 吹き出し内で自動で改行 */
        white-space: normal; /*指定widthに合わせて、文字を自動的に改行*/
    }

    .bms_message_box {
        margin-top: 20px; /*上下の吹き出しがひっつかない様に隙間を入れる*/
        max-width: 100%; /*文字が長くなった時に吹き出しがタイムラインからはみ出さない様にする*/
        font-size: 16px;
    }

    .bms_message_content {
        padding: 20px; /*文字や画像（コンテンツ）の外側に隙間を入れる*/
    }

    /* メッセージ１（左側） */
    .bms_left {
        float: left; /*吹き出しをbms_messagesに対して左寄せ*/
        line-height: 1.3em;
    }

    .bms_left .bms_message_box {
        color: #333; /*テキストを黒にする*/
        background: #fff;
        border: 2px solid tomato;
        border-radius: 30px 30px 30px 0px; /*左下だけ尖らせて吹き出し感を出す*/
        margin-right: 50px; /*左側の発言だとわかる様に、吹き出し右側に隙間を入れる*/
    }

    /* メッセージ２（右側） */
    .bms_right {
        float: right; /*吹き出しをbms_messagesに対して右寄せ*/
        line-height: 1.3em;
    }

    .bms_right .bms_message_box {
        color: #fff; /*テキストを白にする*/
        background: tomato;
        border: 2px solid tomato;
        border-radius: 30px 30px 0px 30px; /*右下だけ尖らせて吹き出し感を出す*/
        margin-left: 50px; /*右側の発言だとわかる様に、吹き出し左側に隙間を入れる*/
    }

    /* 回り込みを解除 */
    .bms_clear {
        clear: both; /* 左メッセージと右メッセージの回り込み(float)の効果の干渉を防ぐために必要（これが無いと、自分より下のメッセージにfloatが影響する） */

    }

    /* テキストエリア、送信ボタン④ */
    #bms_send {
        background-color: #eee; /*タイムラインの色と同じにする*/
        border-right: 1px solid #ddd;
        border-left: 1px solid #ddd;
        height: 50px;
        padding: 5px;
    }

    #bms_send_message {
        width: calc(100% - 75px); /*常に送信ボタンの横幅を引いたサイズに動的に計算*/
        line-height: 16px;
        height: 48px;
        padding: 14px 6px 0px 6px; /*文字がテキストエリアの中心になる様に隙間調整*/
        border: 1px solid #ccc;
        border-radius: 4px; /*角丸*/
        text-align: left; /*文字を左寄せ*/
        box-shadow: 2px 2px 4px 0px rgba(0, 0, 0, 0.2) inset; /*内側に影を入れてテキストエリアらしくした*/
        box-sizing: border-box; /*paddingとborderの要素の高さと幅の影響をなくす（要素に高さと幅を含める）*/

    }

    #bms_send_btn {
        width: 72px;
        height: 48px;
        font-size: 16px;
        line-height: 3em;
        float: right; /*bms_sendに対して右寄せ*/
        color: #fff;
        font-weight: bold;
        background: #bcbcbc;
        text-align: center; /*文字をボタン中央に表示*/
        border: 1px solid #bbb;
        border-radius: 4px; /*角丸*/
        box-sizing: border-box; /*paddingとborderの要素の高さと幅の影響をなくす（要素に高さと幅を含める）*/
    }

    #bms_send_btn:hover {
        background: tomato; /*マウスポインタを当てた時にアクティブな色になる*/
        cursor: pointer; /*マウスポインタを当てた時に、カーソルが指の形になる*/
    }

    #room_item_detail {
        width: 25%;
    }

    #item_image img {
        width: 300px;
        height: 300px;
        object-fit: cover;
    }
</style>
