@extends("admin.layout")
@section("content")
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    @include("admin.template.error")
                    @include("admin.template.success")
                    <form>
                        @csrf
                        @include("admin.template.tool_bar_index")
                        @include("admin.core.list")
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
