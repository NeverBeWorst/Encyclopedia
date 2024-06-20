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
        <a href="{{ route ('admin.main') }}"><p>Назад</p></a>
    </div>
    
    <div class="info_block">
        <div class="picture">
            <a href="../../../img/users/proposal_creature/carts/{{ $creature->img }}"><img src="../../../img/users/proposal_creature/carts/{{ $creature->img }}" alt="Фото/картина существа"></a>
            <a class="download_icon" href="../../../img/users/proposal_creature/carts/{{ $creature->img }}" download><img src="../../../img/icons/download.png" alt="Скачать"></a>
        </div>
        

        <div class="short_info">
            <p class="name">{{$creature->name}}</p>
            <div><p>Мифология: </p><p>{{$creature->mythology}}</p></div>
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
</section>
@endsection