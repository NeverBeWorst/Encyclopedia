<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="@yield('style')">
    <title>@yield('pagename')</title>
</head>
<body>
    <div class="main_background">
        @include('inc.header')

        <main class="content">
        @if ($errors->any())
            <div >
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
            @yield('content')
        </main>

        @include('inc.footer')
    </div>
    
</body>
</html>