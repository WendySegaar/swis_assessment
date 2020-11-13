<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Wendy Segaar">

    <title>School Holidays</title>

    <link rel="stylesheet" type="text/css" href="/css/main.css"/>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>@yield('title')</h1>
    </header>
    <div class="content">
        @yield('content')

    </div>
    <footer>
        @yield('footer')
    </footer>
</body>
</html>
