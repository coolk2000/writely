@extends('layouts.master')

@section('content')
    <div class="container">
    <h1>{{ $page->title }}</h1>

    <article>{!! $page->body !!}</article>

    {{--@unless ($page->tags->isEmpty())--}}
    {{--<h5>Tags:</h5>--}}
    {{--<ul>--}}
        {{--@foreach ($page->tags as $tag)--}}
            {{--<li>{{ $tag->name }}</li>--}}
        {{--@endforeach--}}
    {{--</ul>--}}
    {{--@endunless--}}
    {{--</div>--}}
@stop