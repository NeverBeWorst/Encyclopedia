@extends('layout.app')

@section('style')
{{asset('css/admin.css')}}
@endsection

@section('pagename')
Админка
@endsection

@section('content')

@if ($errors->any())
    <div >
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section>
    <div><h2>Форма для создания существа</h2></div><br>

    <div class="creature_form">
        <form action="{{ route('creature.submit') }}" method="post">
        @csrf
            <div class="form_block">
                <div>
                    <input type="text" name="name" id="name" placeholder="Введите имя" required><br>
                    <input type="text" name="img" placeholder="Введите наименование фото" required><br>
                    
                    <select name="mythology" id="mythology" placeholder="Выбирите мифологию"  required>
                        <option value="" selected disabled hidden>Мифология</option>
                        @foreach($_mythology as $criterion)
                        <option value="{{$criterion}}" >{{$criterion}}</option>
                        @endforeach
                    </select><br>
                    
                    <select name="habitat" id="habitat" placeholder="Выбирите место проживания сущности" required>
                        <option value="" selected disabled hidden>Среда обитания</option>
                        @foreach($_habitat as $criterion)
                        <option value="{{$criterion}}" >{{$criterion}}</option>
                        @endforeach
                    </select><br>

                    <input type="text" name="short_description" placeholder="Введите краткое описание"><br>

                    <button type="submit">Отправить</button>
                </div>
                
                <textarea rows="10"  name="description" placeholder="Введите Описание"></textarea><br>
            </div>
        </form>

        <form method="post" action="{{ route('creatures_image.submit') }}" enctype="multipart/form-data">
            @csrf 
            <div>
                <input type="text" name="img_name" placeholder="Введите как хотите назвать картинку"><br>
                <input type="file" name="image"><br>
                
                <button type="submit">Отправить</button>
            </div>

            <img class="your-image" src="" alt="">
        </form>

        <form action="{{ route('creature_with_img.submit') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form_block">
                <div>
                    <input type="text" name="name" id="name" placeholder="Введите имя" required><br>
                    <input type="text" name="img_name" placeholder="Введите как хотите назвать картинку"><br>
                    <input type="file" name="image"><br>
                    
                    <select name="mythology" id="mythology" placeholder="Выбирите мифологию" required>
                        <option value="" selected disabled hidden>Мифология</option>
                        @foreach($_mythology as $criterion)
                        <option value="{{$criterion}}" >{{$criterion}}</option>
                        @endforeach
                    </select><br>
                    
                    
                    <select name="habitat" id="habitat" placeholder="Выбирите место проживания сущности" required>
                        <option value="" selected disabled hidden>Среда обитания</option>
                        @foreach($_habitat as $criterion)
                        <option value="{{$criterion}}" >{{$criterion}}</option>
                        @endforeach
                    </select><br>

                    <input type="text" name="short_description" placeholder="Введите краткое описание"><br>

                    <button type="submit">Отправить</button>
                </div>
                
                <textarea rows="10"  name="description" placeholder="Введите Описание"></textarea><br>
            </div>
        </form>

        <form action=""></form>
    </div>

    <div class="users_list">
        <p><a href="{{ route('users') }}">Пользователи</a></p>
    </div>

    <div>
        <p><a href="{{ route('proposal_add_creature') }}">Список предложений к добавлению</a></p>
    </div>
</section>

<?php

?>

@endsection