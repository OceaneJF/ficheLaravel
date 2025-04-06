@extends("base")

@section('content')
    <h1>Se connecter</h1>
    <div>
        <form action="{{route('login')}}" method="post">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{old('email')}}">
                @error("email")
                {{$message}}
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                @error("password")
                {{$message}}
                @enderror
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </div>
@endsection
