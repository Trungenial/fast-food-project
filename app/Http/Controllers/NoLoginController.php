<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMailNoLogin;
class NoLoginController extends Controller

{
    public function nologin(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return view('pages.nologin', ['items' => [], 'total' => 0]);
        }

        $provinces = DB::table('provinces')->get();
        $districts = DB::table('districts')->get();
        $wards = DB::table('wards')->get();

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
        return view('pages.nologin', compact('items', 'total', 'provinces', 'districts', 'wards'));
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
        // Lấy tên tỉnh, huyện, xã từ request
            $provinceName = '';
            $districtName = '';
            $wardName = '';

            // Kiểm tra nếu có giá trị được chọn
            if ($request->filled('province')) {
                $provinceName = DB::table('provinces')
                    ->where('code', $request->input('province'))
                    ->value('name');
            }

            if ($request->filled('district')) {
                $districtName = DB::table('districts')
                    ->where('code', $request->input('district'))
                    ->value('name');
            }

            if ($request->filled('ward')) {
                $wardName = DB::table('wards')
                    ->where('code', $request->input('ward'))
                    ->value('name');
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
            'province'        => $provinceName, 
            'districts'       => $districtName, 
            'wards'           => $wardName,     
            'full_address'    => $request->input('full_address'),
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
        DB::table('payments')->insert([
            'order_id' => $orderId,
            'method' => $method,
            'status' => $method === 'cash' ? 'paid' : 'pending',
            'transaction_id' => null,
            'created_at' => now(),
        ]);
        $order = DB::table('orders_without_login')->where('id', $orderId)->first();
        $items = DB::table('order_items')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->where('order_id', $orderId)
        ->select('products.name', 'order_items.quantity', 'order_items.price')
        ->get();

    // Gửi email bằng Mail class mới
        Mail::to($request->input('email'))->send(new OrderPlacedMailNoLogin($order, $items));
        if(session()->forget('cart')){
            $status = 'Đặt hàng thành công!';

            return redirect()->route('order')->with('status', 'Đặt hàng thành công!');
        }
    }

    

}
