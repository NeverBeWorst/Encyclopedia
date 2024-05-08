<header>
    <div><h1>@yield('pagename')</h1></div>
    
    <ul>
        <li><a href="{{route('home')}}">Главная</a></li>
        <li><a href="{{route('gallery')}}">Галарея</a></li>
        <li><a href="{{route('profile')}}">Профиль</a></li>
        <li>
            @if(!auth()->user())  
                <a href="{{route('login')}}">Войти</a>  
            
            @else 
                <a href="{{route('login.logout')}}">Выйти</a> 
            @endif 
        </li>
    </ul>
</header>