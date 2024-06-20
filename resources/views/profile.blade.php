@extends('layout.app')

@section('style')
{{asset('css/profile.css')}}
@endsection

@section('pagename', 'Профиль')

@section('content')

<section>
    <ul class="users_info">
        <li>
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
        </li>

        <li class="short_info">
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

            

            <div class="user_status">
                <div class="about_me">
                        <p>Обо мне</p>
                        <div class="text">
                            @if (Auth::user())
                            <p>{{ Auth::user()->about_me }}</p>
                            @else
                            <p>Текст обо мне.</p>
                            @endif
                        </div>
                        @if(Auth::user())
                        <a href="{{ route('user.about_me') }}">
                            <p>Редактировать</p>
                        </a>
                        @endif
                    </div>

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
           
        </li>
        <li>
            <ul class="cards">
                <li class="card">
                <a href="{{ route('user.proposal_creature') }}">                   
                    <div>
                        <p class="card_title">Кого-то не хватает?</p>
                        <img src="../img/icons/free-icon-dragons-4214982.png" alt="" class="card_icon">
                        <p class="card_text">Помогите нам дополнить нашу “Мифическую Энциклопедию”</p>
                    </div>                   
                </a>
            </li>
            <li class="card">
                <a href="">                   
                    <div>
                        <p class="card_title">В разработке</p>
                        <img src="../img/icons/free-icon-gorgon-5240966.png" alt="" class="card_icon">
                        <p class="card_text">Находится в разработке</p>
                    </div>             
                </a>
            </li>
            <li class="card">
                <a href="{{ route('user.image.generator') }}">               
                    <div>
                        <p class="card_title">Создайте своего</p>
                        <img src="../img/icons/free-icon-herne-the-hunter-4924605.png" alt="" class="card_icon">
                        <p class="card_text">Создайте свирепое или милое существо.<br />Включите воображение!</p>
                    </div>
                </a>
            </li>
            </ul>
        </li>

        <li>
            <div class="friends_box">
                <div class="my_friends">
                    <p>Мои друзья</p>
                    <div>
                    
                        @if (Auth::user())

                        @if ($friends->count() == '0')
                            <p>У вас пока нет друзей</p>
                        @else 
                        <ol>
                            @foreach($friends as $friend) 
                            <li>{{ $friend->sent_from }}</li>
                            @endforeach
                        </ol>
                        <br>
                        @endif
                        
                        @else
                        <ol>
                            <li><p>Здесь ваши друзья</p></li>
                        </ol>
                        @endif
                    </div>    
                </div>

                <div class="friends_request">
                    <p>Предложения дружбы</p>
                    <div>
                        
                        @if (Auth::user())

                        @if ($friends_request->count() == '0')
                            <p>У вас пока нет друзей</p>
                        @else 
                        <ol>
                            @foreach($friends_request as $friend_request) 
                            <li>
                                <p>{{ $friend_request->sent_from }} 
                                    <form action="{{ route('user.friend_request.confirm', [$friend_request->sent_from]) }}" method="post">@csrf <button type="submit">Принять</button></form>
                                    <form action="{{ route('user.friend_request.reject', [$friend_request->sent_from]) }}" method="post">@csrf <button type="submit">Отклонить</button></form>
                                </p>
                            </li>
                            @endforeach
                        </ol>
                        <br>
                        @endif
                        
                        @else
                        <ol>
                            <li><p>Здесь ваши друзья</p></li>
                        </ol>
                        @endif
                    </div>
                </div>
            </div>

            <div class="my_comments">
                <p>Мои комментарии</p>
                <div>
                    @if (Auth::user())

                        @if ($reviews->count() == '0')
                            <p>У вас пока нет комментариев</p>
                        @else 
                        <ol>
                            @foreach($reviews as $review) 
                            <li>{{ $review->text }} </li>
                            @endforeach
                        </ol>
                        <br>
                        @endif
                        
                        @else
                        <ol>
                            <li><p>Здесь ваши комментарии</p></li>
                        </ol>
                    @endif
                </div>
            </div>
        </li>
    </ul>

    <div class="my_custom_creatures">
        @if (Auth::user())
        <h2>Ваши пользовательские сущности</h2>

        @if ($custom_creatures->count() == 0)
        <p class="no_creatures">Сейчас у вас нет своих мифических существ</p>

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
