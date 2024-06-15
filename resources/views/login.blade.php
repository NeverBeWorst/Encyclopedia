@extends('layout.app')

@section('style')
{{asset('css/login.css')}}
@endsection

@section('pagename', 'Авторизация')

@section('content')
<section>
    <div class="general_form">
        <h1 class="">Авторизация</h1>
        <form action="{{ route('login.submit') }}" method="post">
            @csrf
            <div class="">
                <label>Логин</label><br>
                <input type="text" name="login" class="" placeholder="Введите имя" minlength="2" maxlength="32" required>
            </div>

            <div class="">
                <label>Пароль</label><br>
                <input type="password" name="password" class="" placeholder="Введите пароль" minlength="6" maxlength="32" required>
            </div>

            <button type="submit" class="">Авторизоваться</button>
        </form>
        {{-- <a href="">Забыли пароль?</a> --}}
    </div>
</section>

@endsection