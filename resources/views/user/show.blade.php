@extends('layouts.master')

@section('content')
    <div class="container" id="container">
        <h2 class="sequl-heading">{{ $user->username }}&nbsp;
            <small>
                <div id="tagline" style="display:inline-block">
                @if ($user->tagline == '')
                    (a very interesting individual)
                @else
                    &ldquo;{{ $user->tagline }}&rdquo;
                @endif
                </div>
            </small>
        </h2>
        <hr class="hr-definition">
    </div>

    {{--<script>
        $('html').click(function() {
            $('#taglineEditBox').hide();
            $('#tagline').show();
            $('#toggleTaglineEdit').show();
        });

        $('#container').click(function(e){
            e.stopPropagation();
        });

        $('#toggleTaglineEdit').click(function() {
            $('#tagline').toggle();
            $('#taglineEditBox').toggle();
            $('#toggleTaglineEdit').toggle();
        });
    </script>--}}
@stop