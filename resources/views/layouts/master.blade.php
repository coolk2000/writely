<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/compiled/css/app.css" rel="stylesheet">
    <link href="/compiled/css/min.css" rel="stylesheet">
    @yield('head')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Karma:300,500,700,600' rel='stylesheet' type='text/css'>
    <script language="JavaScript" type="text/javascript" src="/compiled/js/min.js"></script>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <a class="navbar-brand" style="font-family:'Karma',sans-serif;font-weight:600;color:#5e8cde;font-size:200%;padding-top:18px" href="/home">sequl</a>
        @if (isset($user))
            @if ($user != null)
                <p class="navbar-text pull-right"><a href="/user/{{ $user->username }}">{{ $user->username }}</a></p>
            @else
                <p class="navbar-text pull-right">Not signed in</a></p>
            @endif
        @else
            <p class="navbar-text pull-right">Not signed in</a></p>
        @endif
        @yield('navbar')
    </nav>
    @yield('content')
</body>
</html>