@extends('layout.app')

@section('style')
{{asset('css/admin/proposal_add_creature.css')}}
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

<section>
        <div><a href="{{ route('admin.main') }}">
            <p>Назад</p>
        </a></div>
        
        <div></div>
        <div></div>
        <div></div>
    </section>

@endsection