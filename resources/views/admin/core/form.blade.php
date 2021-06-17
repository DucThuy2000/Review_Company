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
            </ul>
            <!------- End navigate ------->

            <!------- Tab Content ------->
            <div class="tab-content">
                @foreach($fieldForm as $key => $tab)
                    <div class="tab-pane {{ $key == $keyActive ? "active" : "" }} pt-3" id="{{ $key }}" role="tabpanel">
                        {!! \App\Helper\Form::renderForm($tab['items'], @$singleRecord) !!}
                    </div>
                @endforeach
            </div>
            <!------- End Tab Content ------->
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-dark" href="{{ route("admin." . $controllerName . ".index") }}">Cancel</a>
            </div>
        </form>
    </div>
@stop
