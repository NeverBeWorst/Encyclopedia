@extends('layout.app')

@section('style')
{{asset('css/profile.css')}}
@endsection

@section('pagename')
Профиль
@endsection

@section('content')

<section>
    <div class="flex">
        <div>
            @if(auth()->user() )
            <p>Логин: {{session()->get('user_name')}}</p>
            <a href="{{route('login.logout')}}">Выйти</a>
            <!-- <p>Тест отправки на почту</p> -->
            <!-- <a href="">Проверить</a> -->

        
            @else 
            <p>Гостевой режим</p>
            <p>Зарегистрируйтесь, пожалуйста</p>
            @endif
        </div>

        
        <div>
            @if(!auth()->user())
            <a href="{{ route('login') }}">Авторизация</a>
            <br>
            <a href="{{ route('reg') }}">Регистрация</a>
            @endif
        </div>
        
    </div>

    @if(Auth::user() && Auth::user()->role == 'admin')
    <a href="{{ route('admin.main') }}">Страница администратора</a>
    @endif

    @if(Auth::user())
    <div>
        <ol>
            <li>
                <div><a href="{{ route('user.proposal_creature') }}">Предложение к добавлению</a></div>
            </li>

            <li>
                <div><a href="{{ route('user.custom_creature') }}">Пользовательская сущность</a></div>
            </li>
            <li></li>
        </ol>
    </div>
    @endif
    
</section>


@endsection