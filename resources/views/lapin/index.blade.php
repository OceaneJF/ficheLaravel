@extends('base')

@section('content')
    <form method="post" action="{{route('lapin.update',['lapin' => $lapin])}}" class="p-6">
        @method('PUT')
        @csrf
        <div id="update-box" class="hidden text-green-700 text-3xl">
            UPDATED
        </div>
        <div>
            <input class="border" placeholder="nicolas" type="text" name="name" required value="{{$lapin->name}}">
            @error('filename')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input class="border" placeholder="nicolas" type="number" name="size" value="{{$lapin->size}}">
            @error('filename')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input class="border" placeholder="nicolas" type="email" name="email" required value="{{$lapin->email}}">
            @error('filename')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Envoyer</button>
    </form>
@endsection
