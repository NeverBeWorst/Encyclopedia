@extends('layout.minigames')

@section('style')
{{ asset('css/minigames/find_pair.css') }}
@endsection

@section('pagename')
Найди пару
@endsection

@section('scripts')
<script src="{{ asset('js/minigames/find_pair.js') }}"></script>
@endsection

@section('content')
<div class="game-container">
    <div class="cards-grid" id="cards-grid"></div>
</div>

<div>
    <form action=""></form>
</div>

<script type="text/javascript">

    function get_creature() {
        let creatures = new Array();
        let i = 0;

        @foreach($creatures as $creature) 
        creatures[i] = '{{ $creature->img }}';
        i++;
        @endforeach

        return creatures;
    }
  
</script>
@endsection