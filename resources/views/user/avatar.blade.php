@extends('layout.app')

@section('style')
{{asset('css/user/avatar.css')}}
@endsection

@section('pagename', 'Добавить аватар')

@section('content')
<section>
    <div class="general_form">
        <form method="post" action="{{ route('user.avatar.submit') }}" enctype="multipart/form-data">
            @csrf 
            <div><label for="image">Выберите фото для вашего нового аватара</label></div>
            <div><input type="file" name="image"></div>
            <div><button type="submit">Отправить</button></div>
        </form>
    </div>    
</section>
@endsection