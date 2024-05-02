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
            <div class="first_filtration">
                <div class="select_block">
                    <div>
                        <p>Выберите какая мифология вам нужна</p>
                        <select  name="mythology" id="mythology" placeholder="Выбирите мифологию">
                            <option value="" selected disabled hidden>Мифология</option>
                            @foreach($_mythology as $criterion)
                            <option value="{{$criterion}}" @if($criterion == $mythology) selected @endif >{{$criterion}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <p>Выберите какая местоность вам нужна</p>
                        <select name="habitat" id="habitat" placeholder="Выбирите место проживания сущности">
                            <option value="" selected disabled hidden>Среда обитания</option>
                            @foreach($_habitat as $criterion)
                            <option value="{{$criterion}}"  @if($criterion == $habitat) selected @endif >{{$criterion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="creature_name">
                    <p>Введите имя нужной вам сущности</p>
                    <input  type="text" name="name" value="{{ $name }}" placeholder="Введите имя">
                </div>
            </div>

            <div class="second_filtration">
                <ol class="">
                    <p>Добавить пользовательских сущностей?</p>
                    <p><input name="custom" type="radio" value="" checked>Без них</p>
                
                    <p><input name="custom" type="radio" value="with_custom">Добавить</p>
                
                    <p><input name="custom" type="radio" value="only_custom">Оставить только пользовательские сущности</p>
                </ol>

                <input class="search" type="submit" value="Поиск">
            </div>

            
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
        @if ($creature->user)
        <a href="{{ route('gallery.custom_creature', [$creature->id]) }}"> 
            <div class="creature">
                <div class="seam">
                    <p class="name">{{$creature->name}}</p>
                    <div class="picture"><img src="img/users/custom_creature/carts/{{$creature->img}}" alt="Фото/картина существа"></div> 
                    <p class="short_description">{{$creature->short_description}}</p>
                </div>
            </div>
        </a>

        @else
        <a href="{{ route('gallery.creature', [$creature->id]) }}"> 
            <div class="creature">
                <div class="seam">
                    <p class="name">{{$creature->name}}</p>
                    <div class="picture"><img src="img/carts/{{$creature->img}}" alt="Фото/картина существа"></div> 
                    <p class="short_description">{{$creature->short_description}}</p>
                </div>
            </div>
        </a>
        @endif
        
        
        @endforeach
        @endif

        @if ($creatures->count() == 0)
        <div><p>Ничего не найдено</p></div>
        @endif
    </div>

    
    
</section>
@endsection