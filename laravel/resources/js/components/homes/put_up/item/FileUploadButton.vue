<template>
    <div class="image_upload">
        <div class="uploadButton">
            <img :src="'/images/icons/form_icons/file_upload.png'"
                 alt="file_icon">
            ファイルを選択
            <input name="image" type="file"
                   onchange="uv.style.display='inline-block'; uv.value = this.value;"/>
            <input type="text" id="uv" class="uploadValue" disabled/>
        </div>
    </div>

</template>

<script>
    export default {
        name: "FileUploadButton",
    }
</script>

<style scoped>
    .uploadButton {
        font-size: 1.3rem;
        display:inline-block;
        position:relative;
        overflow:hidden;
        border-radius:3px;
        background:#fff;
        color:tomato;
        text-align:center;
        padding:10px 0;
        margin-left: 20px;
        line-height:30px;
        width:200px;
        cursor:pointer;
        border: 3px solid tomato;
    }
    .uploadButton:hover {
        background:tomato;
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
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        cursor:pointer;
        opacity:0;
    }
    .uploadValue {
        display:none;
        background:rgba(255,255,255,1);
        border-radius:3px;
        padding:3px;
        color:tomato;
        font-size: 1rem;
    }

</style>
