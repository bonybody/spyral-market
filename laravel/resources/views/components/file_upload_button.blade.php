<link rel="stylesheet" href="{{asset('css/components/file_upload_button.css')}}">
<div class="image_upload">
    <div class="uploadButton">
        <img src="{{asset('images/icons/form_icons/file_upload.png')}}"
             alt="file_icon">
        ファイルを選択
        <input name="image" type="file"
               onchange="uv.style.display='inline-block'; uv.value = this.value;"/>
        <input type="text" id="uv" class="uploadValue" disabled/>
    </div>
    @error('image')
    <p class="form_error">{{$message}}</p>
    @enderror
</div>
