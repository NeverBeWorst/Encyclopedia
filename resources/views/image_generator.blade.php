@extends('layout.app')

@section('style')
{{asset('css/.css')}}
@endsection

@section('pagename')

@endsection

@section('content')
<div>
    <form action="{{ route('generate.image') }}" method="POST">
        @csrf
        <input name="description" type="text">
        <input type="submit">
    </form>

    
    @isset($imageBytes)
            <h2>Generated Image:</h2>
            <img src="data:image/jpeg;base64,{{ base64_encode($imageBytes) }}" alt="Generated Image">
            
            {{-- <form action="{{ route('save.image') }}" method="POST">
                @csrf
                <input type="hidden" name="image_url" value="{{ $imageUrl }}">
                <input type="hidden" name="description" value="{{ $description }}">
                <button type="submit" class="btn btn-success">Save Image</button>
            </form> --}}
        @endisset
</div>
@endsection