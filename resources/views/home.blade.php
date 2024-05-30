@extends('layout.app')

@section('style')
{{asset('css/home.css')}}
@endsection

@section('pagename')
Главная
@endsection

@section('content')
<section class="about_us">
    <h2>О нас</h2>
    <div>
        <ul>
            <li>Наш сайт - это <bold> "Великая Энциклопедия" </bold></li>
            <li>В нас безграничное количество существ со всего света и не только</li>
            <li>Мы расширяем свои знания каждый день, наполняясь великой и мистической силой</li>
        </ul>
        <img src="img/img1.jpg" alt="">
    </div>
</section>

<section class="about_myth">
    <h2>"Миф" и его понятия</h2>
    <div>
        <p>Что же такое миф?!</p>
        <p>Миф — это фольклорный жанр, который иллюстрирует представления человека об устройстве мира. 
            Отдельные мифы в каждой цивилизации складывались в систему мифологии и служили основой для верований и религий. </p>
            <p>Само слово «миф» — древнегреческое и переводится как «сказание» или «предание».</p>
        <img src="img/img2.jpg" alt="">
    </div>
</section>

<section class="join_to_us">
    <h2>Вступайте к нам</h2>
    <div>
        <p>Присоединяйтесь к нашему сообществу и давайте вместе изучать этот мистический мир</p>
        <p class="button">
            <a href="{{route('profile')}}">
                Перейти в профиль
            </a>
            <a href="{{route('image.generator')}}">
                <p>ИИ</p>
            </a>
        </p>
    </div>
</section>
@endsection