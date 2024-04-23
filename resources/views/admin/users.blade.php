@extends('layout.app')

@section('style')
{{asset('css/admin/users.css')}}
@endsection

@section('pagename')
Пользователи
@endsection

@section('content')
<section class="users_list">
    <div><a href="{{ route('admin.main') }}">
        <p>Назад</p>
    </a></div>

    <form action="{{ route('admin.users.search') }}" method="post">
        @csrf
        <input type="text" name="id" placeholder="id">
        <input type="text" name="name" placeholder="Имя">
        <input type="submit" value="Найти">
    </form>
    <ol>
        @if ($search)
            <li>
                <p>{{ $users->id }}</p>
                <p>{{ $users->login }}</p>
                <p>{{ $users->email }}</p>
                <p>{{ $users->created_at }}</p>
                <p>{{ $users->update_at }}</p>
                <!-- <p><a href="{{ route('admin.user_block', [$users->id]) }}">Заблокировать</a></p> -->
                <p><form action="{{ route('admin.user_delete', [$users->id]) }}" method="post"> @csrf <input type="submit" value="Удалить"> </form></p>
            </li>
        @endif
        @if (!$search)
            @foreach($users as $user)
            <li>
                <p>{{ $user->id }}</p>
                <p>{{ $user->login }}</p>
                <p>{{ $user->email }}</p>
                <p>{{ $user->created_at }}</p>
                <p>{{ $user->update_at }}</p>
                <!-- <p><a href="{{ route('admin.user_block', [$user->id]) }}">Заблокировать</a></p> -->
                <p><form action="{{ route('admin.user_delete', [$user->id]) }}" method="post"> @csrf <input type="submit" value="Удалить"> </form></p>
            </li>
            @endforeach
        @endif
        
    </ol>
</section>
    
@endsection