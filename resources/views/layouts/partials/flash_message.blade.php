@if(Session::has('flash_message') || session('status') )
    <div class="alert alert-success text-center" role="alert" alert-message>
        @if(Session::has('flash_message'))
            <h3>{{ Session::get('flash_message') }}</h3>
        @elseif(session('status'))
            <h3>{{ session('status') }}</h3>
        @endif
    </div>
@endif