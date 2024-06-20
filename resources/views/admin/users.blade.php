@extends('layout.app')

@section('style')
{{asset('css/admin/users.css')}}
@endsection

@section('pagename', 'Пользователи')

@section('content')
<section class="users_list">
    <div><a href="{{ route('admin.main') }}">
        <p>Назад</p>
    </a></div>

    <div class="general_form">
        <form action="{{ route('admin.users.search') }}" method="post">
            @csrf
            <div><input type="text" name="id" placeholder="id"></div>
            <div><input type="text" name="name" placeholder="Имя"></div>
            <div><button type="submit">Найти</button></div>
        </form>
    </div>

    <table class="users_list">
        @if ($search)
        <tr>
            <td>{{ $users->id }} </td>
            <td>{{ $users->login }} </td>
            <td>{{ $users->email }} </td>
            <td>{{ $users->status }} </td>
            <td>{{ $users->created_at }} </td>
            <td><form action="{{ route('admin.user_block', [$users->id]) }}" method="post"> @csrf <input type="submit" value="Заблокировать"> </form></td>
            <td><form action="{{ route('admin.user_unblock', [$users->id]) }}" method="post"> @csrf <input type="submit" value="Разблокировать"> </form></td>
            <td><form action="{{ route('admin.user_delete', [$users->id]) }}" method="post"> @csrf <input type="submit" value="Удалить"> </form></td>
        </tr>
        @endif
        @if (!$search)
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->login }} </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status }}</td>
                <td>{{ $user->created_at }}</td>
                <td><form action="{{ route('admin.user_block', [$user->id]) }}" method="post"> @csrf <input type="submit" value="Заблокировать"> </form></td>
                <td><form action="{{ route('admin.user_unblock', [$user->id]) }}" method="post"> @csrf <input type="submit" value="Разблокировать"> </form></td>
                <td><form action="{{ route('admin.user_delete', [$user->id]) }}" method="post"> @csrf <input type="submit" value="Удалить"> </form></td>
            </tr>
            @endforeach
        @endif
    </table>
</section>
    
@endsection