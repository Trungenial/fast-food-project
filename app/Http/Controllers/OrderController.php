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
        // Lấy thông tin đơn hàng, bao gồm tên người đặt và chi tiết đơn hàng
        $order = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')  // Join với bảng users để lấy tên người đặt
            ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')  // Join với bảng order_items để lấy chi tiết đơn hàng
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')  // Join với bảng products để lấy thông tin sản phẩm
            ->where('orders.id', $id)
            ->select('orders.*', 'users.name as user_name', 'order_items.*', 'products.name as product_name', 'products.price as product_price')
            ->get();
        $products = DB::table('products')->get();

        // Kiểm tra xem đơn hàng có tồn tại không
        if ($order->isEmpty()) {
            return redirect()->route('orders.index');
        }
    
        // Truyền dữ liệu đến view
        return view('orders.edit', compact('order', 'products'));
    }
    
    


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'shipping_address' => 'nullable|string|max:255',
            'receiver_phone' => 'nullable|string|max:20',
            'status' => 'required|in:pending,processing,completed,canceled',
            'order_items' => 'nullable|array',
            'order_items.*.product_id' => 'required|integer',
            'order_items.*.quantity' => 'required|integer|min:1',
            'new_product' => 'nullable|integer|exists:products,id',
            'new_product_quantity' => 'nullable|integer|min:1',
        ]);
    
        // Cập nhật thông tin đơn hàng
        DB::table('orders')
            ->where('id', $id)
            ->update([
                'shipping_address' => $request->input('shipping_address'),
                'receiver_phone' => $request->input('receiver_phone'),
                'status' => $request->input('status'),
                'updated_at' => now(),
            ]);
    
        // Cập nhật hoặc thêm chi tiết đơn hàng
        foreach ($request->input('order_items') as $item) {
            $existingItem = DB::table('order_items')->where('order_id', $id)
                                                    ->where('product_id', $item['product_id'])
                                                    ->first();
    
            if ($existingItem) {
                DB::table('order_items')
                    ->where('id', $existingItem->id)
                    ->update([
                        'quantity' => $item['quantity'],
                        'price' => DB::table('products')->where('id', $item['product_id'])->value('price'),
                    ]);
            } else {
                DB::table('order_items')->insert([
                    'order_id' => $id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => DB::table('products')->where('id', $item['product_id'])->value('price'),
                ]);
            }
        }
    
        // Thêm sản phẩm mới nếu có
        if ($request->has('new_product') && $request->input('new_product')) {
            DB::table('order_items')->insert([
                'order_id' => $id,
                'product_id' => $request->input('new_product'),
                'quantity' => $request->input('new_product_quantity'),
                'price' => DB::table('products')->where('id', $request->input('new_product'))->value('price'),
            ]);
        }
    
        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }
    

    public function destroy($id)
    {
        DB::table('orders')->where('id', $id)->delete();
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xoá.');
    }
}
