<template>
    <div id="user_image">
        <img
            v-if="user_detail.image !== 'no_image'"
            :src="'/storage/users/' + user_detail.image"
            :style="img_size"
        >
        <img
            v-else
            :src="'/images/no_user_image.jpg'"
            :style="img_size"
        >
    </div>
</template>

<script>
    export default {
        name: "user-image",
        props: [
            'user_detail',
            'img_size',
        ],
    }
</script>

<style scoped>

</style>
