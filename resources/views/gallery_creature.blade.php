@extends('layout.app')

@section('style')
{{asset('css/gallery_creature.css')}}
@endsection

@section('pagename')
{{$creature->name}}
@endsection

@section('content')
<section>
    <div class="back_button">
        <a href="{{ route ('gallery') }}"><p>Назад</p></a>
    </div>
    
    <div class="info_block">
        <div class="picture">
            
            <img src="../../{{$creature->img}}" alt="Фото/картина существа"> 
            <a class="download_icon" href="../../{{$creature->img}}" download><img src="../../img/icons/download.png" alt="Скачать"></a>
        </div>
        

        <div class="short_info">
            <p class="name">{{$creature->name}}</p>
            <div><p>Мифология: </p><p>{{$creature->mythology}}</p></div>
            <div><p>Краткое сведение: </p><p class="short_description">{{$creature->short_description}}</p></div>
            <div><p>Место обитания: </p><p>{{$creature->habitat}}</p></div>
        </div>
    </div>

    <div class="creature_description">
        <p>Основная информация:</p>
        <p class="description">{{$creature->description}}</p>
    </div>

    <div class="comment_block">
        @if(session()->get('user_name') )
        <div>
            <p>Оставьте свой коммментарий:</p>
            <form action="{{ route('gallery_creature.submit', [$creature->id]) }}" method="post">
                @csrf
                <label>Текст:</label>
                <br>
                <input class="text" type="text" name="text" placeholder="Введите текст">
                <br>
                <input type="submit">
            </form>
        </div>
        @endif

        <div class="comments">
            <p>Комментарии других пользователей:</p>

            @foreach($reviews as $review)
                <div>
                    <p class="user_name">{{$review->user_name}}</p>
                    <p>{{$review->text}}</p>
                </div>
            @endforeach
        </div>
        


    </div>
    
</section>

@endsection