<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->withErrors(['error' => 'Your cart is empty.']);
        }

        $items = [];
        $total = 0;
        foreach ($cart as $id => $qty) {
            $product = Product::find($id);
            if (!$product) continue;
            $items[] = ['product' => $product, 'quantity' => $qty, 'subtotal' => $product->price * $qty];
            $total += $product->price * $qty;
        }

        return view('checkout.index', compact('items', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $data = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:50',
            'shipping_address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->withErrors(['error' => 'Your cart is empty.']);
        }

        DB::beginTransaction();
        try {
            $total = 0;
            $items = [];
            foreach ($cart as $id => $qty) {
                $product = Product::lockForUpdate()->find($id);
                if (!$product) {
                    throw new \Exception('Product not found.');
                }
                if ($qty > $product->quantity) {
                    throw new \Exception('Only ' . $product->quantity . ' items are available for ' . $product->name);
                }
                $items[] = ['product' => $product, 'quantity' => $qty];
                $total += $product->price * $qty;
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'Pending',
                'payment_method' => 'Cash on Delivery',
                'shipping_name' => $data['shipping_name'],
                'shipping_phone' => $data['shipping_phone'],
                'shipping_address' => $data['shipping_address'],
            ]);

            foreach ($items as $it) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $it['product']->id,
                    'quantity' => $it['quantity'],
                    'price' => $it['product']->price,
                ]);

                $it['product']->decrement('quantity', $it['quantity']);
            }

            DB::commit();
            session()->forget('cart');
            return redirect()->route('customer.orders')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
