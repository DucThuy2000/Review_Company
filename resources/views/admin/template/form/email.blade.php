<div class="form-group">
    <label>{{ $item['label'] }}</label>
    <input type="{{ $item['type'] }}" class="form-control" name="{{ $item['name'] }}" value="{{ @$old_record[$item['name']] }}">
</div>
