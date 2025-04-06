@extends('base')

@section('content')
    <h1>Create a product</h1>
    <div>
        <a href="{{route('product.index')}}">Retour</a>
    </div>
    <form action="{{route('product.store')}}" method="post">
        @csrf
        <div>
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div>
            <label>
                Name
            </label>
            <input type="text" name="name" placeholder="name">
        </div>
        <div>
            <label>
                Qty
            </label>
            <input type="number" name="qty" placeholder="quantity">
        </div>
        <div>
            <label>
                Price
            </label>
            <input type="number" name="price" placeholder="price">

        </div>
        <div>
            <label>
                Description
            </label>
            <textarea name="description" placeholder="Description"></textarea>

        </div>
        <div>
            <input type="submit" value="save a new product">
        </div>
    </form>
@endsection
