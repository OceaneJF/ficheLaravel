@extends('base')

@section('content')
    <h1>Edit a product</h1>
    <div>
        <a href="{{route('product.index')}}">Retour</a>
    </div>
    <form action="{{route('product.update',['product'=>$product])}}" method="post">
        @csrf
        @method('PUT')
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
            <input type="text" name="name" placeholder="name" value="{{$product->name}}">
        </div>
        <div>
            <label>
                Qty
            </label>
            <input value="{{$product->qty}}" type="number" name="qty" placeholder="quantity">
        </div>
        <div>
            <label>
                Price
            </label>
            <input value="{{$product->price}}" type="number" name="price" placeholder="price">

        </div>
        <div>
            <label>
                Description
            </label>
            <textarea name="description" placeholder="Description">{{$product->description}}</textarea>

        </div>
        <div>
            <input type="submit" value="Edit product">
        </div>
    </form>
@endsection
