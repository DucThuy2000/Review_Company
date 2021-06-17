@if( session("action_success") )
    <div class="alert alert-success fade in alert-dismissible show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size: 20px">x</span>
        </button>
        <strong style="color: #ffffff"> {{ session("action_success") }} </strong>
    </div>
@endif
