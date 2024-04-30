@extends('layout.app')

@section('style')
{{asset('css/.css')}}
@endsection

@section('pagename')
Пользовательское существо
@endsection

@section('content')
<section>
    <ul>
        @if($creatures) 
        @foreach($creatures as $creature)
        <li>
            <img src="../../../img/users/custom_creature/carts/{{ $creature->img }}" alt="">
            <p>{{ $creature->user }}</p>
            <p>{{ $creature->name }}</p>
            <p>{{ $creature->habitat }}</p>
            <p>{{ $creature->short_description }}</p>
            <p>{{ $creature->description }}</p>
        </li>
        @endforeach
        @endif
    </ul>
</section>
@endsection