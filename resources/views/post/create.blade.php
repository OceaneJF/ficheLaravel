@extends('base')

@section('title','creer')

@section('content')
    <form method="post" action="{{route('create')}}">
        @csrf
        <input type="text" name="title" placeholder="titre">
        <input type="text" name="body" placeholder="body">
        <button type="submit">Envoyer</button>

    </form>
@endsection
