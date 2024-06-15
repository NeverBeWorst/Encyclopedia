@extends('layout.app')

@section('style')
{{asset('css/admin/proposal_creature.css')}}
@endsection

@section('pagename', 'Пользовательское существо')

@section('content')

<section>
    <div><a href="{{ route('admin.main') }}">
        <p>Назад</p>
    </a></div>
        
    <ul>
        @foreach($creatures as $creature)
        <li>
            <div>
                <p>{{ $creature->id }} |</p>
                <p>{{ $creature->name }} |</p>
                <p>{{ $creature->mythology }} |</p>
                <p>{{ $creature->habitat }} |</p>
                <p>{{ $creature->short_description }} |</p>
                <p>{{ $creature->created_at }} |</p>
                <a href="{{ route('gallery.custom_creature', [$creature->id]) }}"><p>Просмотр</p></a>
            </div>   
        </li>
        @endforeach
    </ul>
</section>
@endsection