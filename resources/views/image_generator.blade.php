@extends('layout.app')

@section('style')
{{asset('css/.css')}}
@endsection

@section('pagename')

@endsection

@section('content')
<div class="container">
    <h1>Generate an Image from Description</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('generate.image') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate Image</button>
    </form>

    @isset($imageBytes)
        <h2>Generated Image:</h2>
        <img src="data:image/jpeg;base64,{{ base64_encode($imageBytes) }}" alt="Generated Image" id="img">
        
        <form action="{{ route('save.image') }}" method="POST" cenctype="multipart/form-data">
            @csrf
            <input type="hidden" name="image_url" value="{{ $imageBytes }}" id="img_s">
            <input type="hidden" name="description" value="{{ $description }}">
            <button type="submit" class="btn btn-success">Save Image</button>
        </form>
    @endisset
</div>

<script>
    var img = document.getElementById('img');
    var img_s = document.getElementById('img_s');
    img_s.value.src = img.src;
</script>
@endsection