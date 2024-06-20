@extends('layout.app')

@section('style')
{{asset('css/user/proposal_add_creature.css')}}
@endsection

@section('pagename', 'Добавление сущности')

@section('content')
<section>
    <div class="general_form">
        <form action="{{ route('user.proposal_creature.submit') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div><input type="text" name="name" id="name" placeholder="Введите имя" required></div>
            <div><input type="file" name="image"></div>
            <div>
                <select name="mythology" id="mythology" placeholder="Выбирите мифологию" required>
                    <option value="" selected disabled hidden>Мифология</option>
                    @foreach($_mythology as $criterion)
                    <option value="{{$criterion}}" >{{$criterion}}</option>
                    @endforeach
                </select>
            </div>
            <div><select name="habitat" id="habitat" placeholder="Выбирите место проживания сущности" required>
                    <option value="" selected disabled hidden>Среда обитания</option>
                    @foreach($_habitat as $criterion)
                    <option value="{{$criterion}}" >{{$criterion}}</option>
                    @endforeach
                </select>
            </div>
            <div><input type="text" name="short_description" placeholder="Введите краткое описание"></div>
            <textarea rows="10"  name="description" placeholder="Введите Описание"></textarea>
            <div><button type="submit">Отправить</button></div>
        </form>
    </div>
</section>
@endsection