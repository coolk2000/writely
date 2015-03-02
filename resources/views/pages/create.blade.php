@extends('layouts.master')

@section('content')
    <div class="container">
    <h1>Write a New Page</h1>

    <hr>

    {!! Form::open(['url' => 'pages']) !!}
        @include('pages.form', ['submitButtonText' => 'Create Page'])
    {!! Form::close() !!}
    </div>

    @include('errors.list')
@stop