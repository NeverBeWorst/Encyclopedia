@extends('layout.app')

@section('style')
{{asset('css/profile.css')}}
@endsection

@section('pagename', 'О себе')

@section('content')
<section>
    <div class="general_form">
        <p>Напишите о себе</p>
        <form action="{{ route('user.about_me.submit') }}" method="POST">
            @csrf
            <textarea name="text">{{ $text }}</textarea> <br>
            <input type="submit">
        </form>
    </div>
    
</section>
@endsection