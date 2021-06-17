@if( $errors -> any() )
    <div class="alert alert-danger fade in alert-dismissible show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size: 20px">x</span>
        </button>
        <ul>
            @foreach( $errors -> all() as $error )
                <li><strong> {{ $error }} </strong></li>
            @endforeach
        </ul>
    </div>
@endif
