@extends('layouts.master')

@section('content')
    <div class="container">
    <h1>Edit: {!! $page->title !!}</h1>

    <hr>

    {!! Form::model($page, ['method' => 'PATCH', 'action' => ['PagesController@update', $page->id]]) !!}
        @include('pages.form', ['submitButtonText' => 'Submit Edit'])
    {!! Form::close() !!}

    @include('errors.list')
    </div>
@stop