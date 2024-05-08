@extends('layout.app')

@section('style')
{{asset('css/profile.css')}}
@endsection

@section('pagename')
Профиль
@endsection

@section('content')

<section>
    <div class="flex">
        <div>
            @if(Auth::user() )
            
            <!-- <p>Тест отправки на почту</p> -->
            <!-- <a href="">Проверить</a> -->
            <div>
            @if (Auth::user()->avatar)
            <img class="avatar" src="../../img/users/avatar/{{ Auth::user()->avatar }}" alt="Аватар">     
            @else      
            <img class="avatar" src="../../img/icons/unknown_avatar.png" alt="Аватар">      
            @endif

            <form method="post" action="{{ route('user.avatar.submit') }}" enctype="multipart/form-data">
                @csrf 
                <input type="file" name="image"><br>
                <button type="submit">Отправить</button>
            </form>

            <p>{{ Auth::user()->login }}</p>
            
        </div>
            <div>
                <img src="" alt="">
                <p>Логин: {{ Auth::user()->login }}</p>
                <a href="{{route('login.logout')}}">Выйти</a>
            </div>

            @if ($custom_creatures) 
            <ul>
            @foreach($custom_creatures as $creature) 
            <li>{{ $creature->name }} , {{ $creature->short_description }}
                <a href="{{ route('gallery.custom_creature', [$creature->id]) }}">
                    <p>Посмотреть</p>
                </a></li>
            @endforeach
            </ul>
            @endif

            <br><p>Предложение дружбы:</p>
            @if ($friends_request)
                <ul>
                    @foreach($friends_request as $friend) 
                    <li>{{ $friend->sent_from }}</li>
                    @endforeach
                </ul>
                <br>

            @else 
            <p>У вас пока нет предложений дружбы</p>
            @endif

            <br><p>Друзья:</p>
            @if ($friends)
                <ul>
                    @foreach($friends as $friend) 
                    <li>{{ $friend->sent_from }}</li>
                    @endforeach
                </ul>
                <br>

            @else 
            <p>У вас пока нет предложений дружбы</p>
            @endif

        
            @else 
            <p>Гостевой режим</p>
            <p>Зарегистрируйтесь, пожалуйста</p>
            @endif
        </div>

        
        <div>
            @if(!auth()->user())
            <a href="{{ route('login') }}">Авторизация</a>
            <br>
            <a href="{{ route('reg') }}">Регистрация</a>
            @endif
        </div>
        
    </div>

    @if(Auth::user() && Auth::user()->role == 'admin')
    <a href="{{ route('admin.main') }}">Страница администратора</a>
    @endif

    @if(Auth::user())
    <div>
        <ol>
            <li>
                <div><a href="{{ route('user.proposal_creature') }}">Предложение к добавлению</a></div>
            </li>

            <li>
                <div><a href="{{ route('user.custom_creature') }}">Пользовательская сущность</a></div>
            </li>
            <li></li>
        </ol>
    </div>
    @endif

    
    
</section>


@endsection