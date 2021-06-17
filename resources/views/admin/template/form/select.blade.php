@php
    if(isset( $item['modal'] )){
        $category = $item['modal']::all();
    }
    else if(isset( $item['data-source'] )){
        $type = $item['data-source'];
    }
@endphp

<div class="select-2 d-flex flex-column">
    <label> Chọn {{ $item['label'] }} </label>
    <select class="single-select" name="{{ $item['name'] }}">
        @if(isset($item['modal']))
            <option>--- Chọn {{ $item['label'] }} ---</option>
            @foreach($category as $c)
                <option value="{{ $c -> id }}" @if($c -> id == @$old_record[$item['name']]) selected @endif>
                    {{ $c -> name }}
                </option>
            @endforeach
        @elseif(isset($item['data-source']))
            <option>--- Chọn {{ $item['label'] }} ---</option>
            @foreach($type as $key => $value)
                <option value="{{ $value }}" @if($value == @$old_record[$item['name']]) selected @endif>
                    {{ $key }}
                </option>
            @endforeach
        @endif
    </select>
</div>

<style>
    .select-2{
        margin-bottom: 15px;
    }
    .select2{
        width: 100% !important;
    }
</style>

