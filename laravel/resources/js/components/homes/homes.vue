<template>
    <div>
        <select v-model="category" name="category" class="key_category">
            <option label="大カテゴリを選択▽">大カテゴリを選択</option>
            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
        </select>

        <select name="sub_category" class="key_category" id="sub_category">
            <option label="中カテゴリを選択▽">中カテゴリを選択</option>
            <option v-for="sub_category in sub_categories" v-if="category == sub_category.category_id"
                    :value="sub_category.id">{{sub_category.name}}
            </option>
        </select>
    </div>




</template>

<script>
    export default {
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

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style module>
    .key_category {
        font-family: 'Kosugi Maru', sans-serif;

        /*リセット*/
        appearance: none;
        border: none;
        outline: none;
        background-color: white;
        border: 3px #000 solid;
        border-radius: 5px;
        font-size: 1.5rem;
        padding: 5px 10px 10px 10px;
    }
    #sub_category {
        margin-right: 10px;
    }

</style>
