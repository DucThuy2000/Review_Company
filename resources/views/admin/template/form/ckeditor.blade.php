<div class="form-group">
    <label> {{$item['label']}} </label>
    <textarea class="ckeditor" col="30" rows="5" name="{{ $item['name'] }}">
        {{ old( $item['name'], @$old_record[$item['name']] ) }}
    </textarea>
</div>
