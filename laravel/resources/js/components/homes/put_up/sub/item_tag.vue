<template>
    <div class="item_tag_component">
        <multiselect v-model="values" :options="options" :multiple="true"
                     :preserve-search="true" placeholder="科目を選択してください" label="name" track-by="name" :taggable="true"
                     @tag="addTag">
        </multiselect>

        <input type="hidden" name="tags" :value="values">
    </div>
</template>

<script>
    export default {
        props: [
            'options',
        ],
        data() {
            return {
                trackBy: 'id',
                values: [],
                options_data: this.options,
            }
        },
        methods: {
            addTag(newTag) {
                const tag = {
                    name: newTag,
                }
                this.options.push(tag)
                this.values.push(tag)
            }
        },
        computed: {
            inputValues: function () {
                var result = [];
                this.values.forEach(function (value) {
                    result.push(value.name);
                })
                return result;
            },
        }
    }
</script>

<style module>

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
