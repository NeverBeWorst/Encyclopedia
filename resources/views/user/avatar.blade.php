@extends('layout.app')

@section('style', '')

@section('pagename', 'Добавить аватар')

@section('content')
<section>
    <div class="general_form">
        <form method="post" action="{{ route('user.avatar.submit') }}" enctype="multipart/form-data">
            @csrf 
            <label for="image">Выберите фото для вашего нового аватара</label><br>
            <input type="file" name="image"><br>
            <button type="submit">Отправить</button>
        </form>
    </div>    
</section>
@endsection