@php
    if(!empty($singleRecord)){
        $action = route("admin." . $controllerName . ".update", ["id" => $singleRecord["id"]]);
    }
    else{
        $singleRecord = [];
        $action = route("admin." . $controllerName . ".store");
    }
@endphp

@extends("admin.layout")
@section("content")
    <div class="box box-primary">
        <form method="POST" enctype="multipart/form-data" action="{{ $action }}">
            @csrf
            <div class="box-body">
            @include("admin.template.error")
            <!------- Tab navigate ------->
                @php
                    $keyActive = "general_tab";
                @endphp
                <ul class="nav nav-tabs" role="tablist">
                    @foreach($fieldForm as $key => $tab)
                        <li class="nav-item">
                            <a class="nav-link {{ $key == $keyActive ? "active" : "" }}" data-toggle="tab" href="#{{ $key }}" role="tab">{{ $tab['tab'] }}</a>
                        </li>
                    @endforeach
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#permission_tab" role="tab">Permissions</a>
                        </li>
                </ul>
                <!------- End navigate ------->

                <!------- Tab Content ------->
                <div class="tab-content">
                    @foreach($fieldForm as $key => $tab)
                        <div class="tab-pane {{ $key == $keyActive ? "active" : "" }} pt-3" id="{{ $key }}" role="tabpanel">
                            {!! \App\Helper\Form::renderForm($tab['items'], @$singleRecord) !!}
                        </div>
                    @endforeach
                    @php
                        $permissions = config("permissions");
                        //dd($permissions);
                        if(!empty($singleRecord)){
                            $decode_permission = json_decode(@$singleRecord -> permissions, true);
                        }
                    @endphp
                        <div class="tab-pane pt-3" id="permission_tab" role="tabpanel">
                            <div class="row">
                                @foreach($permissions as $model => $action)
                                    <div class="col-6 col-lg-6">
                                        <h4 class="text-uppercase text-bold">{{$model}}</h4>
                                        @foreach($action as $key => $value)
                                            @php
                                                $strAction = $model . "." . $key;
                                            @endphp
                                            <div class="form-group pure-checkbox">
                                                <input  type="hidden"
                                                        name="permissions[{{$model}}][{{$key}}]"
                                                        value="off">
                                                <input  type="checkbox"
                                                        class="checkbox"
                                                        name="permissions[{{$model}}][{{$key}}]"
                                                        value="on"
                                                        id="{{$value}}"
                                                        {{ @$decode_permission[$strAction] == true ? "checked" : "" }}>
                                                <label for="{{$value}}">{{ $value }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                </div>
                <!------- End Tab Content ------->
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-dark" href="{{ route("admin." . $controllerName . ".index") }}">Cancel</a>
            </div>
        </form>
    </div>
@stop

<style>
    .pure-checkbox label{
        font-size: 16px;
        font-weight: 400 !important;
    }
</style>
