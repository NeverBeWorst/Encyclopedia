@extends('layout.app')

@section('style')
{{asset('css/user/profile.css')}}
@endsection

@section('pagename')
{{ $user->login }}
@endsection

@section('content')
<section>
    <div class="user_block">
        <div class="short_info">
            <div class="avatar_block">
                @if ($user->avatar)
                <img class="avatar" src="../../img/users/avatar/{{ $user->avatar }}" alt="Аватар пользователя">
                @else
                <img class="avatar" src="../img/icons/unknown_avatar.png" alt="Аватар пользователя">
                @endif      
                <p class="user_name"> {{ $user->login }} </p>
            </div>

            <div>
                <div class="about_me">
                    <p>Обо мне</p>
                    <div class="text">
                        <p>{{  $user->about_me }}</p>
                    </div>
                </div>

                @if (Auth::user())
                <div class="proposal_friend">
                    <form action="{{ route('user.friend_request.submit', [ $user->id ]) }}" method="post">
                    @csrf
                        <button type="submit">Запрос в дружбу</button>
                    </form>
                </div>
                @endif
            </div>           
        </div>
    </div>

    @if ($custom_creatures) 
        <h2 style="text-align: center; margin: 20px;">Пользовательские сущности</h2>

        @if ($custom_creatures->count() == 0)
        <p>У данного пользователя</p>

        @else

        <ul class="creatures">
            @foreach ($custom_creatures as $custom_creature)
            <a href="{{ route('gallery.custom_creature', [$custom_creature->id]) }}"> 
                <li class="creature">
                    <div class="seam">
                        <p class="name">{{$custom_creature->name}}</p>
                        <div class="picture"><img src="../../img/users/custom_creature/carts/{{$custom_creature->img}}" alt="Фото/картина существа"></div> 
                        <p class="short_description">{{$custom_creature->short_description}}</p>
                    </div>
                </li>
            </a>
            @endforeach
        </ul>
        @endif
    @endif
    </section>
@endsection