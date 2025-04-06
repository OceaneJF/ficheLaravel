@extends('base')
@section('content')
    <h1>Products</h1>
    <div>
        @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
    </div>
    <div>
        <div>
            <a href="{{route('product.create')}}">Create a product</a>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Show</th>
                <th>Delete</th>
            </tr>
            @foreach($products as $product)
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
                        <a href="{{route('product.show',['product'=> $product])}}">Show</a>
                    </td>
                    <td>
                        @include('products.delete',['product' => $product])
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
