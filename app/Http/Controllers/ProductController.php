<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($qry) use ($q) {
                $qry->where('name', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
