@extends('layout.app')

@section('style')
{{asset('css/admin/proposal_creature.css')}}
@endsection

@section('pagename', 'Предложения добавления сущности')

@section('content')

<section>
        <div><a href="{{ route('admin.main') }}">
            <p>Назад</p>
        </a></div>
        
        <ul>
            @foreach($creatures as $creature)
            <li>
                <p>{{ $creature->id }}</p>
                <p>{{ $creature->name }}</p>
                <p>{{ $creature->mythology }}</p>
                <p>{{ $creature->habitat }}</p>
                <p>{{ $creature->short_description }}</p>
                <p>{{ $creature->created_at }}</p>
                <p>---------------</p>
                <p>{{ $creature->status }}</p>
                <p><a href="{{ route('admin.proposal_creature.view', [$creature->id]) }}">Просмотр</a></p>
                <form action="{{ route('admin.proposal_creature.confirm', [$creature->id]) }}" method="post"> @csrf <input type="submit" value="Принять"></form>
                <form action="{{ route('admin.proposal_creature.reject', [$creature->id]) }}" method="post"> @csrf <input type="submit" value="Отклонить"></form>
            </li>
            @endforeach
        </ul>
    </section>

@endsection