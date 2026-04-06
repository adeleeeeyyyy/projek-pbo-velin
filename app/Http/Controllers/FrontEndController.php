<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        $products = $query->latest()->paginate(16);
        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load('category');
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)->get();
        return view('shop.show', compact('product', 'related'));
    }

    public function byCategory(Category $category)
    {
        $products = Product::where('category_id', $category->id)->with('category')->latest()->paginate(16);
        $categories = Category::withCount('products')->orderBy('name')->get();
        return view('shop.index', compact('products', 'categories', 'category'));
    }
}
