@extends('layout.app')

@section('style')
{{asset('css/admin.css')}}
@endsection

@section('pagename')
Админка
@endsection

@section('content')
<h1>Привет</h1>
<section>
    <div class="creature_form">
        <p><br>Форма для создания существа</p>
        <form action="{{ route('creature.submit') }}" method="post">
        @csrf
            <div><input type="text" name="name" placeholder="Введите имя" required></div>
            <div><input type="text" name="img" placeholder="Введите наименование фото" required></div>
            <div>
                <select name="mythology" id="mythology" placeholder="Выбирите мифологию" required>
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
            </div>
            <div>
                <select name="habitat" id="habitat" placeholder="Выбирите место проживания сущности" required>
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
            </div>
            <div><input type="text" name="short_description" placeholder="Введите краткое описание"></div>
            <div><textarea rows="10"  name="description" placeholder="Введите Описание"></textarea></div>

            <button type="submit">Отправить</button>
        </form>

        <form method="post" action="{{ route('creature_photo.submit') }}" enctype="multipart/form-data">
            @csrf 
            <div><input type="text" name="name"></div>
            <div><input type="file" name="image"></div>
            
            <button type="submit">Отправить</button>
        </form>
    </div>
</section>
@endsection