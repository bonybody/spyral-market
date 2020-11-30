<template>
    <div id="items_wrap">
        <div class="items" v-for="(item, index) in items" :key="index">
            <item-detail :item="item">
            </item-detail>

        </div>
    </div>

</template>

<script>
    import ItemDetail from "./ItemDetail";

    export default {
        name: "my-item-delete-main",
        components: {ItemDetail},
        props: ['items'],
    }
</script>

<style scoped>
    #items_wrap {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-content: stretch;
        margin: 0 80px;
    }
    .items {
        box-shadow: rgba(0,0,0,0.3) 0 0 10px;
        min-height: 300px;
        width: 200px;
        margin: 30px;
    }

</style>
