@extends('base')

@section('content')
    <form method="post" action="{{route('fichier.create')}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div>
            <input type="file" name="filename" required>
            @error('filename')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input type="file" name="filename2" required>
            @error('filename2')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Envoyer</button>
    </form>
@endsection
