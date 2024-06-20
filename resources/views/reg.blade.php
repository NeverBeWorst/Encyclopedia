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
            <div><input type="text" name="login" class="" placeholder="Введите логин" minlength="2" maxlength="32" required></div>
            <div><input type="password" name="password" class="" placeholder="Введите пароль" minlength="6" maxlength="32" required></div>
            <div><input type="email" name="email" class="" placeholder="Введите email" minlength="2" maxlength="32" required></div>
            <div><button type="submit" class="">Зарегистрироваться</button></div>
        </form>
    </div>
</section>
@endsection