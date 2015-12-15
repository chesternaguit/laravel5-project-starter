<!--

    Todo: Fix this one, as you can see styles are in-lined
          and we dont have time.
-->
@if(Session::has('success') || Session::has('errors'))

<div class="row" style="padding-bottom: 0; {{ (isset($style) ? $style : '')}}">
    <div class="col-md-12" style="margin-bottom: 0">
        <div class="callout {{ (Session::get('success') ? 'callout-success' : 'callout-danger') }}">
            <h4 style="font-weight: bold"> {!! (Session::has('success') ? 'Successful' : 'Error')!!} </h4>
            @if(Session::has('success'))
                <p>{!! Session::get("message") !!}</p>
            @else
                @if(Session::has('message'))
                    {!! Session::get('message') !!}
                @else
                <p><strong>You have an error!</strong> please check your fields</p>
                @endif
            @endif
        </div>
    </div>
</div>

@endif