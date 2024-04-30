@extends('layout.app')

@section('style')
{{asset('css/admin/.css')}}
@endsection

@section('pagename')

@endsection

@section('content')
<section>
    <div>
        <img src="../../../img/users/proposal_creature/carts/{{ $creature->img }}" alt="">
        <p>{{ $creature->id }}</p>
        <p>{{ $creature->name }}</p>
        <p>{{ $creature->mythology }}</p>
        <p>{{ $creature->habitat }}</p>
        <p>{{ $creature->short_description }}</p>
        <p>{{ $creature->created_at }}</p>
        <p>{{ $creature->description }}</p>
        <p>---------------</p>
        <p>{{ $creature->status }}</p>
        <form action="{{ route('admin.proposal_creature.confirm', [$creature->id]) }}" method="post"> @csrf <input type="submit" value="Принять"></form>
        <form action="{{ route('admin.proposal_creature.reject', [$creature->id]) }}" method="post"> @csrf <input type="submit" value="Отклонить"></form>
    </div>
</section>
<li>
        
                
            </li>
@endsection