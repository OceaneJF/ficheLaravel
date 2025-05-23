@extends('base')
@section('content')
    <h1>Product {{$product->name}}</h1>
    <div>
        <div>
            <a href="{{route('product.index')}}">Retour</a>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->qty}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->description}}</td>
                <td>
                    <a href="{{route('product.edit',['product'=> $product])}}">Edit</a>
                </td>
                <td>
                    <form method="post" action="{{route('product.destroy',['product'=>$product])}}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        </table>
    </div>
@endsection
