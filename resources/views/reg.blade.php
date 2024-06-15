@extends('layout.app')

@section('style')
{{asset('css/reg.css')}}
@endsection

@section('pagename', 'Регистрация')

@section('content')
<section>
    <div class="general_form">
        <h1 class="">Регистрация пользователя</h1>
        <form action="{{ route('reg.submit') }}" method="post">
            @csrf
            <div class="">
                <label>Логин</label><br>
                <input type="text" name="login" class="" placeholder="Введите логин" minlength="2" maxlength="32" required>
            </div>

            <div class="">
                <label>Пароль</label><br>
                <input type="password" name="password" class="" placeholder="Введите пароль" minlength="6" maxlength="32" required>
            </div>

            <div class="">
                <label>Email</label><br>
                <input type="email" name="email" class="" placeholder="Введите email" minlength="2" maxlength="32" required>
            </div>

            <button type="submit" class="">Зарегистрироваться</button>
        </form>
    </div>
</section>
@endsection