@extends('layout.app')

@section('style')
{{asset('css/custom_creature.css')}}
@endsection

@section('pagename', 'Пользовательское существо')

@section('content')
<section>
    <div class="general_form">
        <form action="{{ route('user.custom_creature.submit') }}" method="post" enctype="multipart/form-data">
        @csrf
                <div><input type="text" name="name" id="name" placeholder="Введите имя" required></div>
                <div><input type="hidden" name="image" value="{{ $image }}"></div>
                <div>
                    <select name="habitat" id="habitat" placeholder="Выбирите место проживания сущности" required>
                        <option value="" selected disabled hidden>Среда обитания</option>
                        @foreach($_habitat as $criterion)
                        <option value="{{$criterion}}" >{{$criterion}}</option>
                        @endforeach
                    </select><br>
                </div>

                <div><input type="text" name="short_description" placeholder="Введите краткое описание"></div>
                <div><button type="submit">Отправить</button></div>    
                <div><textarea rows="10"  name="description" placeholder="Введите Описание"></textarea></div>
        </form>
    </div>
</section>
@endsection