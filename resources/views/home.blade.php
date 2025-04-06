@extends('base')


@section('content')
    <h1>Les derniers films</h1>
    <a href="{{route('showCreate')}}">Créer</a>
    <div class="d-flex flex-column">
        @foreach($posts as $post)
            <h2>{{$post->titre}}</h2>
            <p>{{$post->body}}</p>
        @endforeach

    </div>

@endsection
