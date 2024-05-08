<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="@yield('style')">
    @yield('extra_style')
    <title>@yield('pagename')</title>
</head>
<body>
    <header>
        <a href="{{ route('home') }}">
            <p>Вернуться на главный сайт</p>
        </a>
        <h1>@yield('pagename')</h1>
    </header>

    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>