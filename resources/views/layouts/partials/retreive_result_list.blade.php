
@if(isset($results))
    @if ( !$results->count() )
        You have no Data
    @else
        <ul>
            @foreach( $results as $result )
                <li>{!! link_to_route( $routeName, $result->title, $result->slug ) !!}</li>
            @endforeach
        </ul>
    @endif
@endif