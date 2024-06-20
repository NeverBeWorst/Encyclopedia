@extends('layout.app')

@section('style')
{{asset('css/image_generator.css')}}
@endsection

@section('pagename', 'Сделать фото')

@section('content')
<div>
    <div class="general_form">
        <form action="{{ route('user.generate.image') }}" method="POST">
            @csrf
            <p>Напишите визуальное описание существа которого придумали.</p>
            <div><input name="description" type="text" required min="3" max="300"></div>
            <p>Выбирите тип модели. Если выходят ошибки попробуйте поменять модель.</p>
            <div>
                <select name="model">
                    <option value="0" selected>По умолчанию</option>
                    <option value="1">Более реалистичная</option>
                    <option value="2">Более мультяшное</option>
                </select>
            </div>
            
            <div><input type="submit" value="Создать"></div>
        </form>

        @isset($imageBytes)
        <h2>Generated Image:</h2>
        <img src="data:image/jpeg;base64,{{ base64_encode($imageBytes) }}" alt="Generated Image" class="img-fluid">

        <div class="image_continue">
            <form action="{{ route('user.save.image') }}" method="POST">
                @csrf
                <input type="hidden" name="image_url" value="{{ base64_encode($imageBytes) }}">
                <input type="hidden" name="description" value="{{ $description }}">
                <div><button type="submit" class="btn btn-success">продолжить с этой картинкой</button></div>
            </form>
        </div>
        @endisset
</div>

    
    
</div>
@endsection