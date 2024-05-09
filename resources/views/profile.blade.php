@extends('layout.app')

@section('style')
{{asset('css/profile.css')}}
@endsection

@section('pagename')
Профиль
@endsection

@section('content')

<section>
    <ul class="users_info">
        <li>
            <div class="short_info">
                <div class="avatar_block">
                    <a href=""><img class="avatar" src="../img/icons/unknown_avatar.png" alt=""></a>
                    <p class="user_name">Имя</p>
                </div>

                <div class="notice">
                    <img src="../img/icons/notification_icon_241069.png" alt="">
                </div>
            </div>
            

            <div class="user_status">
                <div class="status">
                    <p>Вы зашли за пользователя</p>
                    <p>Ваш статус: “активен”. Вы имеете все права пользователя</p>
                </div>

                <div class="sign_in_out"> 
                    <div class="secret">
                        <a href="{{ route('secret') }}"><img src="../img/icons/free-icon-mermaid-7931829.png" alt=""></a>
                    </div>
                    

                    <div class="buttons">
                        <a href="{{ route('login') }}"><p class="sign_in">Авторизация</p></a>

                        <div class="sign_up">
                            <a href="{{ route('reg') }}"><p>Регистрация</p></a>
                        </div>
                    </div>
                </div>
                
            </div> 
        </li>

        <li>
            <div class="about_me">
                <p>Обо мне</p>
                <div class="text">
                    <p>Текст обо мне.</p>
                </div>
            </div>

            <ul class="cards">
                <a href="{{ route('user.proposal_creature') }}">
                    <li class="card">
                        <p>Кого-то не хватает?</p>
                        <img src="../img/icons/free-icon-dragons-4214982.png" alt="" class="card_icon">
                        <p>Помогите нам дополнить нашу “Мифическую Энциклопедию”</p>
                    </li>
                </a>

                <a href="{{ route('user.custom_creature') }}">
                    <li class="card">
                        <p>Создайте своего</p>
                        <img src="../img/icons/free-icon-herne-the-hunter-4924605.png" alt="" class="card_icon">
                        <p>Создайте своё свирепое или милое существо. Включите воображение!</p>
                    </li>
                </a>

                <a href="">
                    <li class="card">
                        <p>В разработке</p>
                        <img src="../img/icons/free-icon-gorgon-5240966.png" alt="" class="card_icon">
                        <p>Находится в разработке</p>
                    </li>
                </a>
            </ul>
        </li>

        <li>
            <div class="friends_box">
                <div class="my_friend">
                    <p>Мои друзья</p>
                    <ol>
                        <li>Ринат</li>
                    </ol>
                </div>

                <div class="friends_request">
                    <p>Предложения дружбы</p>
                    <ol>
                        <li></li>
                    </ol>
                </div>
            </div>

            <div class="my_comments">
                <p>Мои комментарии</p>
                <ol>
                    <li></li>
                </ol>
            </div>
        </li>
    </ul>

    <div class="my_custom_creatures">
        <h2>Ваши пользовательские сущности</h2>
        <ul class="creatures">
            <li class="creature">
                <p class="creature_name">Название</p>
                <img src="" alt="">
                <p class="short_description">Краткое описание</p>
            </li>
        </ul>
    </div>
</section>




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