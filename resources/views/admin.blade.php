@extends('layout.app')

@section('style')
{{asset('css/admin.css')}}
@endsection

@section('pagename')
Админка
@endsection

@section('content')

<section>
    <div><h2>Форма для создания существа</h2></div><br>

    <div class="creature_form">
        <form action="{{ route('admin.creature.submit') }}" method="post">
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

        <form method="post" action="{{ route('admin.creatures_image.submit') }}" enctype="multipart/form-data">
            @csrf 
            <div>
                <input type="text" name="img_name" placeholder="Введите как хотите назвать картинку"><br>
                <input type="file" name="image"><br>
                
                <button type="submit">Отправить</button>
            </div>

            <img class="your-image" src="" alt="">
        </form>

        <form action="{{ route('admin.creature_with_img.submit') }}" method="post" enctype="multipart/form-data">
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
        <p><a href="{{ route('admin.users') }}">Пользователи</a></p>
    </div>

    <div>
        <p><a href="{{ route('admin.proposal_creature') }}">Список предложений к добавлению</a></p>
    </div>

    <div>
        <p><a href="{{ route('admin.custom_creature') }}">Список пользовательских существ</a></p>
    </div>

    <br><br><br>
    <div>
        <h2>Острожно!!!!</h2>
        <form action="{{ route('admin.refresh') }}" method="post">@csrf<input type="submit" value="СТЕРЕТЬ БАЗУ ДАННЫХ"></form>
        <form action="{{ route('admin.do_admin') }}" method="post">@csrf <input type="text" name="name"><input type="submit" value="Добавить админа"></form>
    </div>
</section>

@endsection