
<div class="main-list">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                @foreach($fieldList as $col)
                    <th scope="col" class="col-title">{{ $col['label'] }}</th>
                @endforeach
                <th scope="col" class="col-title"> Action </th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $key => $value)
                <tr>
                    @foreach($fieldList as $key => $item)
                        @switch($item['type'])
                            @case('id')
                                <th scope="row">{{ $value -> {$item['name']} }}</th>
                            @break
                            @case("image")
                                <td class="show-image">
                                    <img src="{{ \App\Helper\Functions::getImage($folderUpload, $value -> {$item["name"]}) }}">
                                </td>
                            @break
                            @case('text')
                                <td>{{ $value -> {$item['name']} }}</td>
                            @break
                            @case('first_name')
                                <td>{{ $value -> {$item['name']} }}</td>
                            @break
                            @case('last_name')
                                <td>{{ $value -> {$item['name']} }}</td>
                            @break
                            @case('role')
                                @php
                                    $roleName = $value -> roles -> pluck("name") -> toArray();
                                @endphp
                                <td>
                                    @foreach($roleName as $v)
                                        <label class="label label-success">{{ $v }}</label>
                                    @endforeach
                                </td>
                            @break
                            @case('status')
                                <td>
                                    <label class="label {{ $value -> {$item['name'] == "active" ? "label-success" : "label-danger"} }}">
                                        {{ $value -> {$item['name']} }}
                                    </label>
                                </td>
                            @break
                            @case('dateFormat')
                                <td>{{ $value -> {$item["name"]} -> format('d/m/Y') }}</td>
                            @break
                        @endswitch
                    @endforeach
                        <td>@include("admin.template.action")</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .show-image img{
        width: 100px;
    }
</style>
