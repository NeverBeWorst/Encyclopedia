@extends('layout.minigames')

@section('style')
{{asset('css/minigames/select.css')}}
@endsection

@section('pagename')
Выбор игры
@endsection

@section('content')
<ul>
    <li>
        <a href="{{ route('minigames.find_pair') }}">
            <p>Найди пару</p>
        </a>
    </li>
    <li>
        <a href="">
            <p></p>
        </a>
    </li>
    <li>
        <a href="">
            <p></p>
        </a>
    </li>
    <li>
        <a href="">
            <p></p>
        </a>
    </li>
</ul>
@endsection