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
        
    <table>
        @foreach($creatures as $creature)
        <tr>
            <td>{{ $creature->id }}</td>
            <td>{{ $creature->name }}</td>
            <td>{{ $creature->mythology }}</td>
            <td>{{ $creature->habitat }}</td>
            <td>{{ $creature->short_description }}</td>
            <td>{{ $creature->created_at }}</td>
            <td>Статус: {{ $creature->status }}</td>
            <td><a href="{{ route('admin.proposal_creature.view', [$creature->id]) }}">Просмотр</a></td>
            <td><form action="{{ route('admin.proposal_creature.confirm', [$creature->id]) }}" method="post"> @csrf <input type="submit" value="Принять"></form></td>
            <td><form action="{{ route('admin.proposal_creature.reject', [$creature->id]) }}" method="post"> @csrf <input type="submit" value="Отклонить"></form></td>
        </tr>
        @endforeach
    </table>
</section>

@endsection