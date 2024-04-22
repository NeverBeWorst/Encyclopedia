@extends('layout.app')

@section('style')
{{asset('css/admin/users.css')}}
@endsection

@section('pagename')
Пользователи
@endsection

@section('content')
<div class="users_list">
    <ol>
        @foreach($users as $user)
        <li>
            <p>{{ $user->id }}</p>
            <p>{{ $user->login }}</p>
            <p>{{ $user->email }}</p>
            <p>{{ $user->created_at }}</p>
            <p>{{ $user->update_at }}</p>
            <p><a href="{{ route('user_block', [$user->id]) }}">Заблокировать</a></p>
            <p><form action="{{ route('user_delete', [$user->id]) }}" method="post"> @csrf <input type="submit" value="Удалить"> </form></p>
        </li>
        @endforeach
    </ol>
</div>
    
@endsection