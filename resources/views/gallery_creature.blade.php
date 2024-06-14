@extends('layout.app')

@section('style')
{{asset('css/gallery_creature.css')}}
@endsection

@section('pagename', {{$creature->name}} )

@section('content')
<section>
    <div class="back_button">
        <a href="{{ route ('gallery') }}"><p>Назад</p></a>
    </div>
    
    <div class="info_block">
        <div class="picture">
            @if ($creature->user)
            <img src="../../img/users/custom_creature/carts/{{$creature->img}}" alt="Фото/картина существа"> 
            <a class="download_icon" href="{{ asset('img/users/custom_creature/carts/' . $creature->img) }}" download><img src="{{ asset('img/icons/download.png') }}" alt="Скачать"></a>

            @else
            <img src="../../img/carts/{{$creature->img}}" alt="Фото/картина существа"> 
            <a class="download_icon" href="../../{{$creature->img}}" download><img src="../../img/icons/download.png" alt="Скачать"></a>
            @endif
        </div>
        

        <div class="short_info">
            <p class="name">{{$creature->name}}</p>

            @if ($creature->user_id)
            <div><p>От пользователя: </p> <a href="{{ route('profile.user', [$creature->user_id] ) }}">{{ $autor->login }}</a> </div>
            @else
            <div><p>Мифология: </p><p>{{$creature->mythology}}</p></div>
            @endif

            <div><p>Краткое сведение: </p><p class="short_description">{{$creature->short_description}}</p></div>
            <div><p>Место обитания: </p><p>{{$creature->habitat}}</p></div>
        </div>
    </div>

    <div class="creature_description">
        <p>Основная информация: </p>
        <!-- <p class="description">{{$creature->description}}</p> -->
        <ul class="description">
            @foreach($creature_text as $text)
            <p>{{ $text }}</p>
            @endforeach
        </ul>
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

            @if ($reviews)
            @foreach($reviews as $review)
                <div>
                    <a href="{{ route('profile.user', [$review->user_id] ) }}"><p class="user_name">{{$review->user_name}}</p></a>
                    <p>{{$review->text}}</p>
                </div>
            @endforeach

            @else
            <p>Пока ни кто не оставлял свои комментарии</p>
            @endif
        </div>
        

    </div>
    
</section>

@endsection