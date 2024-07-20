<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductsController extends Controller
{
    public function store(StoreProductRequest $request) : RedirectResponse
    {
        Product::create($request->validated());

        return redirect()->back(); 
    }

    public function delete(Product $product) : RedirectResponse
    {
        $product->delete();

        return redirect()->back();
    }
}
