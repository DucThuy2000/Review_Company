@php
    if(isset($item['modal']))
    {
        $model = new $item['modal'];
        /* Chỉ lấy cột id và name trong bảng product_tags
         * -> toArray() biến những gì vừa select thành 1 mảng
         * */
        $data = $model -> select('id', 'name')->get()->toArray();
    }
    if(!empty($old_record)){
        if( $controllerName == "user" ){
            $old_data = $old_record -> roles() -> get() -> pluck("id") -> toArray();
        }
        else if( $controllerName == "product" ){
            $old_data = $old_record -> tags() -> get() -> pluck("id") -> toArray();
        }
    }
@endphp

<div class="select-2 d-flex flex-column">
    <label> Chọn {{ $item['label'] }} </label>
    <select class="multiple-select" name="{{ $item['name'] }}[]" multiple="multiple">
        @foreach($data as $value)
            <option value="{{ $value['id'] }}"
                @if(isset($old_data))
                {{ in_array($value['id'], $old_data) ? "selected" : "" }}
                @endif>
                {{ $value['name'] }}
            </option>
        @endforeach
    </select>
</div>
