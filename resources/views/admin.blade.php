@extends('layout.app')

@section('style')
{{asset('css/admin.css')}}
@endsection

@section('pagename', 'Админка')

@section('content')

<section>
    <div><h2>Форма для создания существа</h2></div>

    <div class="creature_form">
        <form action="{{ route('admin.creature.submit') }}" method="post">
            <p>Добавить существо с уже загруженным фото</p>
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

                    <div><button type="submit">Отправить</button></div>
                </div>
                
                <textarea rows="10"  name="description" placeholder="Введите Описание"></textarea><br>
            </div>
        </form>

        <form method="post" action="{{ route('admin.creatures_image.submit') }}" enctype="multipart/form-data" class="general_form">
            <p>Загрузить фото на сервер</p>
            @csrf 
            <div><input type="text" name="img_name" placeholder="Введите как хотите назвать картинку"></div>
            <div><input type="file" name="image"></div>
            <div><button type="submit">Отправить</button></div>

            <img class="your-image" src="" alt="">
        </form>

        <form action="{{ route('admin.creature_with_img.submit') }}" method="post" enctype="multipart/form-data">
            <p>Добавить существо с загрузкой фото</p>
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

                    <div><button type="submit">Отправить</button></div>
                </div>
                
                <textarea rows="10"  name="description" placeholder="Введите Описание"></textarea><br>
            </div>
        </form>

        <div class="lists">
            <p><a href="{{ route('admin.users') }}">Список пользователей</a></p>
            <p><a href="{{ route('admin.proposal_creature') }}">Список предложений к добавлению</a></p>
            <p><a href="{{ route('admin.custom_creature') }}">Список пользовательских существ</a></p>
        </div>
    </div>

    <div>

    </div>
    

    <br><br>
    <div class="warning general_form">
        <p>Острожно!!!!</p>
        <form action="{{ route('admin.refresh') }}" method="post">@csrf<input type="submit" value="СТЕРЕТЬ БАЗУ ДАННЫХ"></form>
        <form action="{{ route('admin.do_admin') }}" method="post">@csrf <p>Напишите имя кому дать права администратора</p><input type="text" name="name"> <input type="submit" value="Добавить админа"></form>
    </div>
</section>

@endsection