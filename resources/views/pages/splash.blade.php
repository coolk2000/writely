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
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="auth/register">Register</a></li>
                                <li><a href="auth/login">Login</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="inner cover">
                    <h1 class="cover-heading">Your stories live here.</h1>
                    <p class="lead">From small snippets to big projects, you can count on us to host it all. Free, forever.</p>
                    <p class="lead">
                        <a href="auth/register" class="btn btn-lg btn-default">Start writing</a>
                    </p>
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