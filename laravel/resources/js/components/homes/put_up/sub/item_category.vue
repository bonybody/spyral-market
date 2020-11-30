<template>
</template>

<script>
    export default {
        name: "item_category",
        props: [
            "categories",
            "sub_categories",
        ],
        data: function () {
            return {
                category: "大カテゴリを選択",
            }
        }
    }
</script>

<style scoped>

    .item_category {
        font-family: 'Kosugi Maru', sans-serif;
        display: block;

        /*リセット*/
        appearance: none;
        border: none;
        outline: none;
        background-color: white;

        border: 3px #000 solid;
        border-radius: 5px;
        font-size: 1.5rem;
        padding: 5px 10px 10px 10px;

        margin: 30px auto;
    }

    #item_sub_category {
        display: block;
        margin: 30px auto;
    }


</style>
