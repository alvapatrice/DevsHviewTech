@if (count($errors) > 0)
    <div class="alert alert-danger" alert-message>
        <div class="container">
            <h3><strong>Whoops!</strong> There were some problems with your input.</h3>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    </div>
@endif
