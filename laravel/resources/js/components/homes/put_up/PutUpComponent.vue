<template>
    <form class="put_up" name="put_up" action="put_up" method="post" enctype="multipart/form-data">
        <slot name="csrf_token"></slot>
        <input type="hidden" name="seller_id" :value="seller_id">

        <div class="item_name items">
            <p class="form_label">商品名</p>
            <input v-model="name" type="text" name="name" placeholder="50文字以内">
            <slot name="name_error"></slot>
        </div>
        <hr>
        <div class="item_image items">
            <p class="form_label">商品画像</p>
            <div class="image_upload">
                <div class="uploadButton">
                    <img :src="'/images/icons/form_icons/file_upload.png'"
                         alt="file_icon">
                    ファイルを選択
                    <input type="file" name="image"
                           onchange="uv.style.display='inline-block'; uv.value = this.value;"/>
                    <input type="text" id="uv" class="uploadValue" disabled/>
                </div>
            </div>
            <slot name="image_error"></slot>
        </div>
        <hr>


        <div class="item_price items">
            <p class="form_label">価格設定</p>
            <input v-model="price" type="text" name="price" placeholder="８桁以内">
            <slot name="price_error"></slot>
        </div>
        <hr>

        <div class="item_text items">
            <p class="form_label">商品概要</p>
            <textarea v-model="text" name="text" placeholder="140文字以内" cols="40" rows="7" maxlength="140"></textarea>
            <slot name="text_error"></slot>
        </div>
        <hr>

        <div class="items">
            <p class="form_label">カテゴリ選択</p>

            <p class="item_category_wrap">
                <span>大カテゴリを選択</span>
                <select v-model="category" name="category" class="item_category" options="categories">
                    <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                </select>
            </p>

            <P class="item_category_wrap">
                <span label="中カテゴリを選択">中カテゴリを選択</span>
                <select v-model="sub_category" name="sub_category" class="item_category" id="item_sub_category" options="sub_categories">
                    <option v-for="sub_category in sub_categories" v-if="category == sub_category.category_id"
                            :value="sub_category.id">{{sub_category.name}}
                    </option>
                </select>
            </P>
            <slot name="category_error"></slot>
        </div>
        <hr>
        <div class="item_tag items">
            <p class="form_label">タグ選択</p>
            <div class="item_tag_component">
                <multiselect v-model="values" :options="all_tags" :multiple="true" :close-on-select="false"
                             :clear-on-select="false"
                             :preserve-search="true" placeholder="科目を選択してください" label="name" :track-by=trackBy
                             :taggable="true" @tag="addTag">
                </multiselect>
                <input  type="hidden" name="tags[]" :value="inputValue">
            </div>

            <slot name="tags_error"></slot>
        </div>
        <hr>
        <put-up-dialog-component></put-up-dialog-component>
    </form>

</template>

<script>
    export default {
        name: "PutUpComponent",
        props: [
            'seller_id',
            'categories',
            'sub_categories',
            'all_tags',
            'old',
        ],
        data: function () {
            return {
                name: this.old.name,
                selectedImage: "",
                price: this.old.price,
                text: this.old.text,
                category: "大カテゴリを選択",
                sub_category: "中カテゴリを選択",
                values: [],
                trackBy: 'id',

            }
        },
        methods: {
            addTag (newTag) {
                const tag = {
                    name: newTag,
                }
                this.all_tags.push(tag)
                this.values.push(tag)
            }
        },
        computed: {
            inputValue: function () {
                var result = [];
                this.values.forEach(function (value) {
                    result.push(value.name);
                })
                return result;
            }
        },

    }
</script>

<style scoped>
    .uploadButton {
        font-size: 1.3rem;
        display: inline-block;
        position: relative;
        overflow: hidden;
        border-radius: 3px;
        background: #fff;
        color: tomato;
        text-align: center;
        padding: 10px 0;
        margin-left: 20px;
        line-height: 30px;
        width: 200px;
        cursor: pointer;
        border: 3px solid tomato;
    }

    .uploadButton:hover {
        background: tomato;
        color: #fff;
        animation: ease;
        transition: 0.3s;
    }

    .uploadButton img {
        width: 30px;
        height: 30px;
        vertical-align: bottom;
    }

    .uploadButton input[type=file] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        opacity: 0;
    }

    .uploadValue {
        display: none;
        background: rgba(255, 255, 255, 1);
        border-radius: 3px;
        padding: 3px;
        color: tomato;
        font-size: 1rem;
    }

    .item_category_wrap {
        margin: 30px 0;
    }

    .item_category {
        font-size: 1.5rem;
        padding: 10px;
        border-radius: 10px;
    }
</style>
