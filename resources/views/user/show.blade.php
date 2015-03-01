@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="sequl-heading">{{ $user->username }}&nbsp;<small>@if ($user->tagline == '') (a very interesting individual) @else &ldquo;{{ $user->tagline }}&rdquo; @endif</small></h2>
        <hr class="hr-definition">
    </div>
@stop