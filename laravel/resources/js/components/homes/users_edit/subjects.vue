<template>
    <div>

        <multiselect v-model="value" :options="options" :multiple="true" :close-on-select="false" :clear-on-select="false"
                     :preserve-search="true" placeholder="Pick some" label="subject.name" :track-by=trackBy :taggable="true" >
        </multiselect>
        <p v-for="item in value">{{item.subject.id}}</p>
    </div>
</template>

<script>
    export default {
        props: [
            'options',
            'value',
        ],
        data() {
            return {
                trackBy: 'subject.id',
            }
        }
    }
</script>

<style scoped>

