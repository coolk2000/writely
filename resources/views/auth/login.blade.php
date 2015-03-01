@extends('layouts.master-no-nav')

@section('head')
    <link href="/compiled/css/bootstrap-splash.css" rel="stylesheet">
@stop

@section('content')
    <div class="site-wrapper">

        <div class="site-wrapper-inner">

            <div class="cover-container">

                <div class="masthead clearfix">
                    <div class="inner">
                        <h3 class="masthead-brand">sequl&nbsp;<small>(sequel without the e)</small></h3>
                        <nav>
                            <ul class="nav masthead-nav">
                                <li><a href="/home">Home</a></li>
                                <li><a href="/auth/register">Register</a></li>
                                <li class="active"><a href="#">Login</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="inner cover">

                            <h1>Login.</h1>
                            <h4>Welcome back!</h4>
                        </div>

                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <strong><p class="text-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> {{ $error }}</p></strong>
                        @endforeach
                    @endif

                    <form class="col-md-6 col-md-offset-3" role="form" method="POST" action="/auth/login">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" autofocus>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 input-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <div class="input-group-addon"><a href="/password/email" style="color:#333">forgot?</a></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                            </div>
                        </div>
                    </form>

                    </div>

                </div>

                <div class="mastfoot">
                    <div class="inner">
                        <p style="color:#5e8cde;font-weight:bold;"><3</p>
                    </div>
                </div>

            </div>

        </div>

    </div>

@stop