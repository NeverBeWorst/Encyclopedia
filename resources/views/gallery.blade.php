@extends('layout.app')

@section('style')
{{asset('css/gallery.css')}}
@endsection

@section('pagename')
Галерея
@endsection

@section('content')
<section>
    <div class="filtration">
        <form action="{{ route ('search')}}" method="post">
            @csrf
            <select name="mythology" id="mythology" placeholder="Выбирите мифологию">
                <option value=""></option>
                <option value="Древнегреческая">Древнегреческая</option>
                <option value="Японская">Японская</option>
                <option value="Славянская">Славянская</option>
                <option value="Скандинавская">Скандинавская</option>
                <option value="Финская">Финская</option>
                <option value="Восточноевропейская">Восточноевропейская </option>
                <option value="Индийская">Индийская</option>
                <option value="Другое">Другое</option>
                <option value="Пользовательская">Пользовательская</option>
            </select>

            <select name="habitat" id="habitat" placeholder="Выбирите место проживания сущности">
                <option value=""></option>
                <option value="Болото">Болото</option>
                <option value="Поля/луга">Поля/луга</option>
                <option value="Заброшенные сооружения">Заброшенные сооружения</option>
                <option value="Дома">Дома</option>
                <option value="Сны">Сны</option>
                <option value="Леса">Леса</option>
                <option value="Другое">Другое</option>
                <option value="Пользовательская">Пользовательская</option>
            </select>

            <input type="submit" value="Найти">
        </form>
    </div>

    <div class="scrapbook">
        @if($creatures) 

        @foreach($creatures as $creature) 
        <a href="{{ route('gallery_creature', [$creature->id]) }}"> 
        <div class="creature">
            
            <div class="seam">
                <p class="name">{{$creature->name}}</p>
                <div class="picture"><img  src="{{$creature->img}}" alt="Фото/картина существа"></div> 
                <p class="short_description">{{$creature->short_description}}</p>
            </div>
        </div>
        </a>
        @endforeach

        @else
            <div><p>Ничего не найдено</p></div>
        @endif
    </div>
    
</section>
@endsection