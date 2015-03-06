<!DOCTYPE HTML>
<html lang="en">
<head>
    <script language="JavaScript" type="text/javascript" src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="/compiled/"></script>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/favicon.ico" />
    <link href="/compiled/css/app.css" rel="stylesheet">
    <link href="/compiled/css/min.css" rel="stylesheet">
    @if (isset($title))
        <title>sequl; {{ $title }}</title>
    @else
        <title>sequl</title>
    @endif
    @yield('head')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Karma:300,500,700,600' rel='stylesheet' type='text/css'>
    <script language="JavaScript" type="text/javascript" src="/compiled/js/min.js"></script>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <a class="navbar-brand" style="font-family:'Karma',sans-serif;font-weight:600;color:#5e8cde;font-size:200%;padding-top:18px" href="/home">sequl</a>
        @if (isset($auth_user))
            @if ($auth_user != null)
                <p class="navbar-text pull-right">
                    <a href="/user/{{ $auth_user->username }}">{{ $auth_user->username }}</a>
                    &nbsp;/&nbsp;
                    <a href="/user/settings">settings</a>
                    &nbsp;/&nbsp;
                    <a href="/auth/logout" style="color: #e1312c;">logout</a>
                </p>
            @else
                <p class="navbar-text pull-right"><a href="/auth/login">login</a> / <a href="/auth/register">register</a></p>
            @endif
        @else
            <p class="navbar-text pull-right"><a href="/auth/login">login</a> / <a href="/auth/register">register</a></p>
        @endif
        @yield('navbar')
    </nav>
    @yield('content')
@yield('footer')
</body>
</html>