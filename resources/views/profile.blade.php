@extends('layout.app')

@section('style')
{{asset('css/profile.css')}}
@endsection

@section('pagename')
Профиль
@endsection

@section('content')

@if ($errors->any())
    <div >
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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

    @if(auth()->user() && session()->get('admin') == true)
    <a href="{{ route('admin') }}">Страница администратора</a>
    @endif
    
</section>


@endsection