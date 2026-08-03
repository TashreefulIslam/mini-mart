<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $items = [];
        $total = 0;
        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);
            if (!$product) continue;
            $subtotal = $product->price * $qty;
            $items[] = ['product' => $product, 'quantity' => $qty, 'subtotal' => $subtotal];
            $total += $subtotal;
        }
        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $quantity = max(1, (int)$request->input('quantity', 1));
        $cart = session()->get('cart', []);
        $current = $cart[$product->id] ?? 0;
        $newQty = $current + $quantity;
        if ($newQty > $product->quantity) {
            return back()->withErrors(['error' => 'Only ' . $product->quantity . ' items are available.']);
        }

        $cart[$product->id] = $newQty;
        session()->put('cart', $cart);
        return back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request, Product $product)
    {
        $quantity = max(0, (int)$request->input('quantity', 1));
        $cart = session()->get('cart', []);
        if ($quantity <= 0) {
            unset($cart[$product->id]);
        } else {
            if ($quantity > $product->quantity) {
                return back()->withErrors(['error' => 'Only ' . $product->quantity . ' items are available.']);
            }
            $cart[$product->id] = $quantity;
        }
        session()->put('cart', $cart);
        return back()->with('success', 'Cart updated.');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Item removed.');
    }
}
