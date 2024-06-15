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
            <input type="text" name="id" placeholder="id">
            <input type="text" name="name" placeholder="Имя"><br>
            <input type="submit" value="Найти">
        </form>
    </div>
    
    <ol>
        @if ($search)
            <li>
                <p>{{ $users->id }} | </p>
                <p>{{ $users->login }} | </p>
                <p>{{ $users->email }} | </p>
                <p>{{ $users->status }} | </p>
                <p>{{ $users->created_at }} | </p>
                <!-- <p>{{ $users->update_at }}</p> -->
                <p><form action="{{ route('admin.user_block', [$users->id]) }}" method="post"> @csrf <input type="submit" value="Заблокировать"> </form></p>
                <p><form action="{{ route('admin.user_unblock', [$users->id]) }}" method="post"> @csrf <input type="submit" value="Разблокировать"> </form></p>
                <p><form action="{{ route('admin.user_delete', [$users->id]) }}" method="post"> @csrf <input type="submit" value="Удалить"> </form></p>
            </li>
        @endif
        @if (!$search)
            @foreach($users as $user)
            <li>
                <p>{{ $user->id }} | </p>
                <p>{{ $user->login }} | </p>
                <p>{{ $user->email }} | </p>
                <p>{{ $user->status }} | </p>
                <p>{{ $user->created_at }} | </p>
                <!-- <p>{{ $user->update_at }}</p> -->
                <p><form action="{{ route('admin.user_block', [$user->id]) }}" method="post"> @csrf <input type="submit" value="Заблокировать"> </form></p>
                <p><form action="{{ route('admin.user_unblock', [$user->id]) }}" method="post"> @csrf <input type="submit" value="Разблокировать"> </form></p>
                <p><form action="{{ route('admin.user_delete', [$user->id]) }}" method="post"> @csrf <input type="submit" value="Удалить"> </form></p>
            </li>
            @endforeach
        @endif
    </ol>
</section>
    
@endsection