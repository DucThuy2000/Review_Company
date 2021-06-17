<div class="form-group">
    <labe> {{ $item['label'] }} </labe>
    <textarea cols="30" rows="5" class="form-control" name="{{ $item['name'] }}" style="resize: none">{{ old( $item['name'], @$old_record[$item['name']] ) }}</textarea>
</div>
