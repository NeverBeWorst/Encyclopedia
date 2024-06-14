@extends('layout.app')

@section('style')
{{asset('css/profile.css')}}
@endsection

@section('pagename', 'Профиль')

@section('content')

<section>
    <ul class="users_info">
        <li>
            <div class="short_info">
                <div class="avatar_block">
                    @if (Auth::user())

                    @if (Auth::user()->avatar)
                    <a href="{{ route('user.avatar') }}"><img class="avatar" src="../img/users/avatar/{{ Auth::user()->avatar }}" alt="Аватар пользователя"></a>
                    @else
                    <a href="{{ route('user.avatar') }}"><img class="avatar" src="../img/icons/unknown_avatar.png" alt="Аватар пользователя"></a>
                    @endif
                    
                    @else
                    <img class="avatar" src="../img/icons/unknown_avatar.png" alt="Аватар пользователя">
                    @endif
                    <p class="user_name"> @if (Auth::user()) {{ Auth::user()->login }} @else Имя @endif </p>
                </div>

                <div class="notice">
                    <img src="../img/icons/notification_icon_241069.png" alt="">
                    <div></div>
                </div>
            </div>
            

            <div class="user_status">
                @if (Auth::user())
                    @if (Auth::user()->role == 'admin')
                    <div class="status">
                        <p>Вы зашли за Администратора</p>
                        <p>Ваш статус: “активен”. Вы имеете все права администратора</p>
                    </div>
                    @else
                    <div class="status">
                        <p>Вы зашли за пользователя</p>
                        <p>Ваш статус: “активен”. Вы имеете все права пользователя</p>
                    </div>
                    @endif
                @else
                <div class="status">
                    <p>Вы сейчас в “Гостевом режиме”</p>
                    <p>Если вы тут впервые, вы можете зарегистрироваться</p>
                </div>
                @endif

                <div class="sign_in_out"> 
                    <div class="secret">
                        <a href=""><img src="../img/icons/free-icon-mermaid-7931829.png" alt=""></a>
                    </div>
                    
                    @if (Auth::user())
                    <div class="buttons">
                        @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.main') }}"><p class="sign_in">Страница администратора</p></a>
                        @endif
                        <div class="sign_up">
                            <a href="{{ route('login.logout') }}"><p>Выйти</p></a>
                        </div>
                    </div>
                    @else
                    <div class="buttons">
                        <a href="{{ route('login') }}"><p class="sign_in">Авторизация</p></a>

                        <div class="sign_up">
                            <a href="{{ route('reg') }}"><p>Регистрация</p></a>
                        </div>
                    </div>
                    @endif
                    
                </div>
                
            </div> 
        </li>

        <li>
            <div>
                <div class="about_me">
                    <p>Обо мне</p>
                    <div class="text">
                        @if (Auth::user())
                        <p>{{ Auth::user()->about_me }}</p>
                        @else
                        <p>Текст обо мне.</p>
                        @endif
                    </div>
                    <a href="{{ route('user.about_me') }}">
                        <p>Редактировать</p>
                    </a>
                </div>
            </div>
            

            <ul class="cards">
                <a href="{{ route('user.proposal_creature') }}">
                    <li class="card">
                        <div>
                            <p class="card_title">Кого-то не хватает?</p>
                            <img src="../img/icons/free-icon-dragons-4214982.png" alt="" class="card_icon">
                            <p class="card_text">Помогите нам дополнить нашу “Мифическую Энциклопедию”</p>
                        </div>
                    </li>
                </a>

                <a href="{{ route('user.image.generator') }}">
                    <li class="card">
                        <div>
                            <p class="card_title">Создайте своего</p>
                            <img src="../img/icons/free-icon-herne-the-hunter-4924605.png" alt="" class="card_icon">
                            <p class="card_text">Создайте своё свирепое или милое существо.<br />Включите воображение!</p>
                        </div>
                    </li>
                </a>

                <a href="">
                    <li class="card">
                        <div>
                            <p class="card_title">В разработке</p>
                            <img src="../img/icons/free-icon-gorgon-5240966.png" alt="" class="card_icon">
                            <p class="card_text">Находится в разработке</p>
                        </div>
                    </li>
                </a>
            </ul>
        </li>

        <li>
            <div class="friends_box">
                <div class="my_friends">
                    <p>Мои друзья</p>
                    
                    @if (Auth::user())

                    @if ($friends->count() == '0')
                        <p>У вас пока нет друзей</p>
                    @else 
                    <ul>
                        @foreach($friends as $friend) 
                        <li>{{ $friend->sent_from }}</li>
                        @endforeach
                    </ul>
                    <br>
                    @endif
                    
                    @else
                    <ol>
                        <li><p>Здесь ваши друзья</p></li>
                    </ol>
                    @endif
                </div>

                <div class="friends_request">
                    <p>Предложения дружбы</p>
                    @if (Auth::user())

                    @if ($friends_request->count() == '0')
                        <p>У вас пока нет друзей</p>
                    @else 
                    <ul>
                        @foreach($friends_request as $friend_request) 
                        <li>{{ $friend_request->sent_from }}</li>
                        @endforeach
                    </ul>
                    <br>
                    @endif
                    
                    @else
                    <ol>
                        <li><p>Здесь ваши друзья</p></li>
                    </ol>
                    @endif
                </div>
            </div>

            <div class="my_comments">
                <p>Мои комментарии</p>

                @if (Auth::user())

                    @if ($reviews->count() == '0')
                        <p>У вас пока нет комментариев</p>
                    @else 
                    <ul>
                        @foreach($reviews as $review) 
                        <li>{{ $review->sent_from }}</li>
                        @endforeach
                    </ul>
                    <br>
                    @endif
                    
                    @else
                    <ol>
                        <li><p>Здесь ваши комментарии</p></li>
                    </ol>
                @endif

                @if (Auth::user())
                <ol>
                    @foreach ($reviews as $review)
                    <li>{{ $review }}</li>
                    @endforeach
                </ol>
                @else
                <ol>
                    <li>Здесь ваши комментарии</li>
                </ol>
                @endif
            </div>
        </li>
    </ul>

    <div class="my_custom_creatures">
        @if (Auth::user())
        <h2>Ваши пользовательские сущности</h2>

        @if ($custom_creatures->count() == 0)
        <p>Сейчас у вас нет своих мифических существ</p>

        @else

        <ul class="creatures">
            @foreach ($custom_creatures as $custom_creature)
            <a href="{{ route('gallery.custom_creature', [$custom_creature->id]) }}"> 
                <li class="creature">
                    <div class="seam">
                        <p class="name">{{$custom_creature->name}}</p>
                        <div class="picture"><img src="img/users/custom_creature/carts/{{$custom_creature->img}}" alt="Фото/картина существа"></div> 
                        <p class="short_description">{{$custom_creature->short_description}}</p>
                    </div>
                </li>
            </a>
            @endforeach
        </ul>
        @endif
        @else

        @endif
        
        
    </div>
</section>

@endsection
