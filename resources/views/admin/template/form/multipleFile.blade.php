<div class="form-group">
    <label>{{ $item['label'] }}</label>
    <input multiple name="{{ $item['name'] }}[]" type="file" class="form-control gallery_picture" id="{{ $item['name'] }}">
    <div class="preview_gallery_picture">
        <img class="image_preview" src="" width="300" alt="">
    </div>
</div>
