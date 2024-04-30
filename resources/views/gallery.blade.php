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
                <option value="" selected disabled hidden>Мифология</option>
                @foreach($_mythology as $criterion)
                <option value="{{$criterion}}" @if($criterion == $mythology) selected @endif >{{$criterion}}</option>
                @endforeach
            </select>

            <select name="habitat" id="habitat" placeholder="Выбирите место проживания сущности">
                <option value="" selected disabled hidden>Среда обитания</option>
                @foreach($_habitat as $criterion)
                <option value="{{$criterion}}"  @if($criterion == $habitat) selected @endif >{{$criterion}}</option>
                @endforeach
            </select>
            <input class="search" type="text" name="name" value="{{ $name }}" placeholder="Введите имя">

            <ol>
                <input name="custom" type="radio" value=""> <p>без</p>
            
                <input name="custom" type="radio" value="with_custom"> <p>с</p>
            
                <input name="custom" type="radio" value="only_custom"> <p>только</p>
            </ol>

            <input type="submit" value="Найти">
        </form>
        
        
        <div class="reset_filters">
            <a href="{{route('gallery')}}" >
                <p>Сбросить фильтры</p>
            </a>
        </div>
        
    </div>

    <div class="scrapbook">
        @if($creatures) 

        @foreach($creatures as $creature) 
        <a href="{{ route('gallery_creature', [$creature->id]) }}"> 
        <div class="creature">
            
            <div class="seam">
                <p class="name">{{$creature->name}}</p>
                <div class="picture"><img src="{{$creature->img}}" alt="Фото/картина существа"></div> 
                <p class="short_description">{{$creature->short_description}}</p>
            </div>
        </div>
        </a>
        @endforeach
        @endif

        @if ($creatures->count() == 0)
        <div><p>Ничего не найдено</p></div>
        @endif
    </div>

    
    
</section>
@endsection