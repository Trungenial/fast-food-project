<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoLoginController extends Controller
{
    public function nologin(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return view('pages.nologin', ['items' => [], 'total' => 0]);
        }

        $province = DB::table('provinces')->where('code', $request->province_code)->value('name');

        $productIds = array_keys($cart);
        $products = DB::table('products')->whereIn('id', $productIds)->get();

        $items = [];
        $total = 0;

        foreach ($products as $product) {
            $quantity = $cart[$product->id] ?? 0;
            $subtotal = $product->price * $quantity;
            $total += $subtotal;

            $items[] = [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ];
        }

        return view('pages.nologin', compact('items', 'total', 'province'));
    }

    public function cartdelete(Request $request)
    {
        $id = $request->input('id');
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return back()->with('status', 'Đã xoá sản phẩm khỏi giỏ hàng.');
    }

    public function create_order(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) return back()->with('error', 'Giỏ hàng trống!');

        $productIds = array_keys($cart);
        $products = DB::table('products')->whereIn('id', $productIds)->get();
        $method = $request->input('method', 'cash');
        $total = 0;
        foreach ($products as $product) {
            $quantity = $cart[$product->id] ?? 0;
            $total += $product->price * $quantity;
        }

        
        // Tạo đơn hàng
        $orderId = DB::table('orders_without_login')->insertGetId([
            'first_name'      => $request->input('first_name'),
            'last_name'       => $request->input('last_name'),
            'phone'           => $request->input('phone'),
            'email'           => $request->input('email'),
            'note'            => $request->input('note'),
            'order_note'      => $request->input('order_note'),
            'delivery_method' => $request->input('delivery'),
            'store_id'        => $request->input('store'),
            'city'            => $request->input('city'),
            'time_pickup'     => $request->input('time_pickup'),
            'total_price'     => $total,
            'status' => $method === 'cash' ? 'paid' : 'pending',
            'created_at'      => now(),
        ]);

        // Tạo chi tiết sản phẩm trong đơn hàng
        foreach ($products as $product) {
            DB::table('order_items')->insert([
                'order_id'   => $orderId,
                'product_id' => $product->id,
                'quantity'   => $cart[$product->id],
                'price'      => $product->price,
            ]);
        }

        // Xoá giỏ hàng sau khi đặt
        session()->forget('cart');

        return back()->with('status', 'Đặt hàng thành công!');
    }

}
