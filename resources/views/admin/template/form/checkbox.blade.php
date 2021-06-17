<div class="form-group pure-checkbox">
    <input type="hidden" value="inactive" name="{{ $item['name'] }}" id="uncheck">
    <input class="checkbox" value="active" type="{{ $item['type'] }}" name="{{ $item['name'] }}" id="{{ $item['name'] }}"
    @if(@$old_record[$item['name']] == "active") checked @endif>
    <label for="{{ $item['name'] }}">{{ $item['label'] }}</label>
</div>
