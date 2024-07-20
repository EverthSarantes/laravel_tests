<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BrandsController extends Controller
{
    public function index() : View
    {
        $brands = Brand::all();

        return view('brands.index', compact('brands'));
    }

    public function show(Brand $brand) : View
    {
        return view('brands.show', compact('brand'));
    }

    public function store(StoreBrandRequest $request) : RedirectResponse
    {
        Brand::create($request->validated());

        return redirect()->route('brands.index');
    }

    public function update(StoreBrandRequest $request, Brand $brand) : RedirectResponse
    {
        $brand->update($request->validated());

        return redirect()->route('brands.show', $brand);
    }

    public function delete(Brand $brand) : RedirectResponse
    {
        $brand->delete();

        return redirect()->route('brands.index');
    }
}
