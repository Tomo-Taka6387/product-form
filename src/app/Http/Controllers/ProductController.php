<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        //検索条件（名前や価格など）
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        //並び替え
        if ($request->filled('price_order')) {
            $query->orderBy('price', $request->price_order);
        }

        $products = $query->paginate(6);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $allSeasons = Season::all();
        return view('products.register', compact('allSeasons'));
    }

    public function store(StoreProductRequest $request)
    {
        $imageName = $this->handleImageUpload($request);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image_path' => $imageName,
        ]);
        if ($request->has('seasons')) {
            $product->seasons()->sync($request->seasons);
        }

        return redirect()->route('products.index');
    }

    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $allSeasons = Season::all();
        $imageFiles = \Storage::disk('public')->files('fruit-img');
        $images = array_map(function ($path) {
            return str_replace('fruit-img/', '', $path);
        }, $imageFiles);

        return view('products.detail', compact('product', 'images', 'allSeasons'));
    }

    public function edit($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $allSeasons = Season::all();
        $images = Storage::disk('public')->files('fruit-img');

        return view('products.detail', compact('product', 'images', 'allSeasons'));
    }

    public function update(StoreProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $product->fill($request->except('image_path'));

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/fruit-img', $filename);
            $product->image_path = 'fruit-img/' . $filename;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->season = $request->season;
        $product->description = $request->description;
        $product->seasons()->sync($request->seasons);

        $product->save();
        return redirect('/products');
    }

    public function destroy($productId)
    {
        Product::destroy($productId);
        return Redirect('/products');
    }

    private function handleImageUpload($request)
    {
        dd($request->file('image_path'));

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/fruit-img', $filename);
            return 'fruit-img/' . $filename;
        }
        return null;
    }
}
