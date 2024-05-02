@extends('layout.app')

@section('style')
{{asset('css/profile.css')}}
@endsection

@section('pagename')
{{ $user->login }}
@endsection

@section('content')
<section>
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
</section>
@endsection