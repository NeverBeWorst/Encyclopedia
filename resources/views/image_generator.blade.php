@extends('layout.app')

@section('style')
{{asset('css/.css')}}
@endsection

@section('pagename', 'Сделать фото')

@section('content')
<div>
    <form action="{{ route('user.generate.image') }}" method="POST">
        @csrf
        <p>Напишите визуальное описание существа которого придумали.</p>
        <input name="description" type="text" required min="3" max="300"><br>
        <p>Выбирите тип модели. Если выходят ощибкм попробуйте поменять модель.</p>
        <select name="model">
            <option value="0" selected>1</option>
            <option value="1">2</option>
            <option value="2">3</option>
        </select><br>
        <input type="submit" value="Создать">
    </form>

    
    @isset($imageBytes)
        <h2>Generated Image:</h2>
        <img src="data:image/jpeg;base64,{{ base64_encode($imageBytes) }}" alt="Generated Image" class="img-fluid">
        
        <form action="{{ route('user.save.image') }}" method="POST">
            @csrf
            <input type="hidden" name="image_url" value="{{ base64_encode($imageBytes) }}">
            <input type="hidden" name="description" value="{{ $description }}">
            <button type="submit" class="btn btn-success">продолжить с этой картинкой</button>
        </form>
    @endisset
</div>
@endsection