@extends('layout.app')

@section('style')
{{asset('css/admin/custom_creature.css')}}
@endsection

@section('pagename', 'Пользовательское существо')

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
            <td>{{ $creature->habitat }}</td>
            <td>{{ $creature->short_description }}</td>
            <td>{{ $creature->created_at }}</td>
            <td><a href="{{ route('gallery.custom_creature', [$creature->id]) }}"><p>Просмотр</p></a></td>
        </tr>
        @endforeach
    </table>
</section>
@endsection