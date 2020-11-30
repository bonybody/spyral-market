<template>
    <div class="room" :class="className" v-for="(room, index) in rooms" :key="index">
        <p class="item_image"><img :src="itemImagePath(room.item)" :alt="room.item.name"></p>
    </div>

</template>

<script>
    export default {
        name: "room",
        props: {
            className: {
                default: "room"
            },
            rooms: {
                default: []
            },
        },
        computed: {
            itemImagePath: function () {
                self = this;
                return function (item) {
                    if (item.image == undefined && item.image == null) {
                        return "/images/icons/form_icons/file_upload.png";
                    } else {
                        return `/storage/items/${item.image}`;
                    }
                };
            }
        }

    }
</script>

<style scoped>

</style>
