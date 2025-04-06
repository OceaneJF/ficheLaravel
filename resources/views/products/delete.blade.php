<form method="post" action="{{route('product.destroy',['product'=>$product])}}">
    @csrf
    @method('delete')
    <input type="submit" value="Delete">
</form>
