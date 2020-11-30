<template>
    <div>
        <select v-for="hal in getArray(hals)" :key="index">
            <option value="hal.id">{{hal.name}}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: ['hals'],
        computed: {
            getArray: function (str) {
                const array = JSON.parse(str);
                return array;
            },
    }
    }
</script>
