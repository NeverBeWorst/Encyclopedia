@extends('layout.app')

@section('style', '')

@section('pagename', 'Добавить аватар')

@section('content')
<section>
    <form method="post" action="{{ route('user.avatar.submit') }}" enctype="multipart/form-data">
        @csrf 
            <input type="file" name="image"><br>
            <button type="submit">Отправить</button>
    </form>
</section>
@endsection