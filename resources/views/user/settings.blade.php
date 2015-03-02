@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="sequl-heading">{{ $auth_user->username }}&nbsp;<small>/settings/</small></h2>
        <hr class="hr-definition">
        <div class="row">
            <div class="col-md-3" style="border-right: 1px solid #6DC4FF;">
                <h1>Test</h1>
            </div>

            <div class="col-md-9">
                <h1>Test</h1>
            </div>
        </div>
    </div>
@stop