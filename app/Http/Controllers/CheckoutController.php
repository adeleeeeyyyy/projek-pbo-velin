<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function show()
    {
        $carts = Auth::user()->carts()->where('is_selected', true)->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Pilih setidaknya satu produk untuk checkout.');
        }

        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        return view('shop.checkout', compact('carts', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'postal_code' => 'required|string|max:10',
        ]);

        $user = Auth::user();
        $cartItems = $user->carts()->where('is_selected', true)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong atau tidak ada produk yang dipilih.');
        }

        try {
            return DB::transaction(function () use ($request, $user, $cartItems) {
                $totalAmount = 0;
                $orderItemsData = [];

                foreach ($cartItems as $item) {
                    // Row-level locking to prevent oversell
                    $product = Product::lockForUpdate()->findOrFail($item->product_id);

                    if ($product->stock < $item->quantity) {
                        throw new \Exception("Stok tidak mencukupi untuk produk: {$product->name}");
                    }

                    // Deduct stock
                    $product->decrement('stock', $item->quantity);

                    $subtotal = $product->price * $item->quantity;
                    $totalAmount += $subtotal;

                    $orderItemsData[] = [
                        'product_id' => $product->id,
                        'quantity' => $item->quantity,
                        'price' => $product->price,
                        'subtotal' => $subtotal,
                    ];
                }

                // Create Order
                $order = Order::create([
                    'user_id' => $user->id,
                    'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'postal_code' => $request->postal_code,
                    'total_amount' => $totalAmount,
                    'status' => 'Pending',
                ]);

                // Create Order Items
                foreach ($orderItemsData as $itemData) {
                    $itemData['order_id'] = $order->id;
                    OrderItem::create($itemData);
                }

                // Create initial history
                $order->statusHistories()->create([
                    'status' => 'Pending',
                    'note' => 'Pesanan berhasil dibuat.',
                    'changed_by_user_id' => $user->id,
                ]);

                // Clear cart items
                $user->carts()->where('is_selected', true)->delete();

                return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi admin.');
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
}
