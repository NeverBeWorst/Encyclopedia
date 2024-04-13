@extends('layout.app')

@section('style')
{{asset('css/admin.css')}}
@endsection

@section('pagename')
Предложения добавления сущности
@endsection

@section('content')

@if ($errors->any())
    <div >
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



@endsection