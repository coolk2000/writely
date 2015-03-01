@extends('layouts.master-no-nav')

@section('head')
    <link href="/compiled/css/bootstrap-splash.css" rel="stylesheet">
    <link href="/compiled/css/animate.css" rel="stylesheet">
@stop

@section('content')
    <div class="site-wrapper">

        <div class="site-wrapper-inner">

            <div class="cover-container">

                <div class="masthead clearfix">
                    <div class="inner">
                        <h3 class="masthead-brand animated fadeInDown" id="headerTextAnimation">sequl&nbsp;<small>(sequel without the e)</small></h3>
                        <nav>
                            <ul class="nav masthead-nav">
                                <li class="active animated fadeInDown"><a href="#">Home</a></li>
                                <li class="animated fadeInDown" id="headerNavAnimation2"><a href="auth/register">Register</a></li>
                                <li class="animated fadeInDown" id="headerNavAnimation3"><a href="auth/login">Login</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="inner cover animated fadeInUp" id="headerTextAnimation">
                    <h1 class="cover-heading header-text">Your stories live here.</h1>
                    <p class="lead header-text">From small snippets to big projects, you can count on us to host it all. Free, forever.</p>
                    <p class="lead">
                        <a href="auth/register" class="btn btn-lg btn-default">Start writing</a>
                    </p>
                </div>

                <div class="mastfoot">
                    <div class="inner">
                        <p style="color:#5e8cde;font-weight:bold;" class="inner cover animated zoomIn" id="headerTextAnimation">- Nigel</p>
                    </div>
                </div>

            </div>

        </div>

    </div>

@stop