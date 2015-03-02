@extends('layouts.master')

@section('content')
    <div class="container">
    <h1>Pages</h1>

    <hr>
    @foreach ($pages as $page)
        <article>
            <h2>
                <a href="{{ action('PagesController@show', [$page->id]) }}">{{ $page->title }}</a>
            </h2>

            <div class="body">{{ $page->body }}</div>
        </article>
    @endforeach
    </div>
@stop