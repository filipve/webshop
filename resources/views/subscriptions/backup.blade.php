{{--@if ( !$user->subscribed('main'))--}}
@if($subscribed === 'false')
    <p>You are not currently subscribed. <a href="{{url('/plans')}}">Join now</a> </p>

    @if($cancelled === 'true')
        <p>Your subscription will end on {{$user->subscription('main')->ends_at->format(' D d M Y')}} </p>
    @endif

    <ul>@if(!$user->subscription('main')->cancelled())
            <li>
                <a href="{{url('/plans/cancel')}}">Cancel my subscription</a>
            </li>
        @else
            <li>
                <a href="{{url('/plans/resume')}}">Resume my subscription</a>
            </li>
        @endif
    </ul>


@else












@endif