<template>
    <div>
        <textarea
            placeholder="メッセージを入力"
            v-model="messageText">
        </textarea>

        <button @click="sendMessage"></button>
    </div>
</template>

<script>
    export default {

        name: "chat-composer",
        data: function () {
            return {
                messageText: "",
            }
        },

        methods: {
            sendMessage(){
                if (this.messageText){
                    this.$emit("message-sent",{
                        message: this.messageText,
                    });
                    this.messageText = "";
                }
            }
        }

    }
</script>

<style scoped>

</style>
