<div class="form-group">
    @if($item)
        <label for="{{ $item['name'] }}">{{ $item['label'] }}:</label>
        <input autocomplete="off" class="form-control {{ $item['name'] }}" name="{{ $item['name'] }}"
               value="{{ old( $item['name'], @$old_record[$item['name']] ) }}" type="{{ $item['type'] }}">
    @endif
</div>
