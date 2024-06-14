@extends('layout.app')

@section('style')
{{asset('css/gallery.css')}}
@endsection

@section('pagename', 'Галерея')

@section('content')

<section>
    <div class="filtration">
        <form action="{{ route ('search')}}" method="post" id="searchForm">
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
                    <input type="text" id="searchText" name="name" value="{{ $name }}" placeholder="Введите имя">
                    <ol id="suggestions">
                        
                    </ol>
                </div>
            </div>

            <div class="second_filtration">
                <ol class="">
                    <p>Добавить пользовательских сущностей?</p>
                    <p><input name="custom" type="radio" value="" checked>Без них</p>
                
                    <p><input name="custom" type="radio" value="with_custom">Добавить</p>
                
                    <p><input name="custom" type="radio" value="only_custom">Только пользовательские сущности</p>
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
        @if ($creature->user_id)
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchText');
    var suggestionsContainer = document.getElementById('suggestions');
    var searchForm = document.getElementById('searchForm');

    if (searchInput && suggestionsContainer) {
        
        searchInput.addEventListener('input', function() {
            var searchText = searchInput.value.trim();
            if (searchText.length > 0) {
                fetchSuggestions(searchText);
            } else {
                suggestionsContainer.innerHTML = '';
            }
        });

        suggestionsContainer.addEventListener('click', function(event) {
            if (event.target.tagName === 'LI') {
                searchInput.value = event.target.textContent;
                suggestionsContainer.innerHTML = ''; // Очистка подсказок после выбора
                searchForm.submit(); // Отправка формы
            }
        });
    }

    function fetchSuggestions(searchText) {
        fetch("{{ route('search.suggestions') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ searchText: searchText })
        })
        .then(response => response.json())
        .then(data => {
            suggestionsContainer.innerHTML = '';
            data.forEach(function(suggestion) {
                var suggestionElement = document.createElement('li');
                suggestionElement.textContent = suggestion;
                suggestionsContainer.appendChild(suggestionElement);
            });
        });
    }
});
</script>

@endsection
