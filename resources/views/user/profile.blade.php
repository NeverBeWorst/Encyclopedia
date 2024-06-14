@extends('layout.app')

@section('style')
{{asset('css/profile.css')}}
@endsection

@section('pagename', {{ $user->login }})

@section('content')
<section>
    <div>
        @if ($user->avatar)
        <img src="../../img/users/avatar/{{ $user->avatar }}" alt="Аватар">
        @else 
        <img src="../../img/icons/unknown_avatar.png" alt="Аватар">
        @endif
        <p>{{ $user->login }}</p>
    </div>

    @if (Auth::user())
    <div>
        <form action="{{ route('user.friend_request.submit', [ $user->id ]) }}" method="post">
        @csrf
            <button type="submit">Запрос в дружбу</button>
        </form>
    </div>
    @endif

    @if ($custom_creatures) 
        <ul>
        @foreach($custom_creatures as $creature) 
        <li> 
            <img src="../../img/users/custom_creature/carts/{{ $creature->img }}" alt="">
            <div>
                <p>{{ $creature->name }}</p>
                <p>{{ $creature->short_description }}</p>
            </div>
            <a href="{{ route('gallery.custom_creature', [$creature->id]) }}">
                <p>Посмотреть</p>
            </a></li>
        @endforeach
        </ul>
        @endif
</section>
@endsection