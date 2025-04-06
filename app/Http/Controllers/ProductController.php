<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function showMyProducts()
    {
        $products = [];
        if (auth()->check()) {
            $products = auth()->user()->userProducts()->get();
        }
        return view('products.myProduct', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        Product::create($data);
        return redirect()->route('product.index');
    }

    public function edit(Product $product)
    {
        if (auth()->user()->id !== $product['user_id']) {
            return redirect()->back();
        }
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, ProductRequest $request)
    {
        $data = $request->validated();
        $product->update($data);
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if (auth()->user()->id !== $product['user_id']) {
            return redirect()->back();
        }
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }
}
