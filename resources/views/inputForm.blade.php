@extends('base')

@section('content')

    <form method="post" action="">
        @csrf
        <input type="text" name="address">
        <button type="submit">Envoyer</button>
    </form>
    <div>
        <h1>{{$wheatherDto->name}}</h1>
        <ul>
            <li>{{$wheatherDto->main}}</li>
            <li>{{$wheatherDto->description}}</li>
        </ul>
        <img src="https://openweathermap.org/img/wn/{{$wheatherDto->icon}}@2x.png">
    </div>
@endsection
