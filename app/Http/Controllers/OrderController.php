<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        // Join bảng orders với bảng users để lấy tên người đặt
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name')
            ->orderByDesc('orders.created_at')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        DB::table('orders')->insert([
            'user_id' => $request->user_id,
            'store_id' => $request->store_id,
            'shipping_address' => $request->shipping_address,
            'receiver_phone' => $request->receiver_phone,
            'total_price' => $request->total_price,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được tạo.');
    }

    public function show($id)
    {
        // Lấy thông tin đơn hàng cùng với tên người đặt và chi tiết đơn hàng
        $order = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')  // Join với bảng users để lấy tên người đặt
            ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')  // Join với bảng order_items để lấy chi tiết đơn hàng
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')  // Join với bảng products để lấy thông tin sản phẩm
            ->where('orders.id', $id)
            ->select('orders.*', 'users.name as user_name', 'order_items.*', 'products.name as product_name', 'products.price as product_price')
            ->get();
    
        // Kiểm tra xem đơn hàng có tồn tại không
        if ($order->isEmpty()) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }
    
        // Truyền dữ liệu đến view
        return view('orders.show', compact('order'));
    }
    

    public function edit($id)
    {
        $order = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'orders.id',
                'orders.shipping_address',
                'orders.receiver_phone',
                'orders.status',
                'users.name as user_name',
                'products.name as product_name',
                'products.id as product_id',
                'products.price as product_price',
                'order_items.quantity'
            )
            ->where('orders.id', $id)
            ->get();

        if ($order->isEmpty()) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'shipping_address' => 'nullable|string|max:255',
            'receiver_phone' => 'nullable|string|max:20',
            'status' => 'required|in:pending,processing,completed,canceled',
        ]);

        DB::table('orders')
            ->where('id', $id)
            ->update([
                'shipping_address' => $request->input('shipping_address'),
                'receiver_phone' => $request->input('receiver_phone'),
                'status' => $request->input('status'),
                'updated_at' => now(),
            ]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

}
