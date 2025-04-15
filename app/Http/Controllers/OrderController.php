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
        // Lấy thông tin đơn hàng và tên người dùng
        $order = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name')
            ->where('orders.id', $id)
            ->first();

        if (!$order) abort(404);

        return view('orders.show', compact('order'));
    }

    public function edit($id)
{
    // Lấy thông tin đơn hàng theo ID
    $order = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')  // Join với bảng users để lấy tên người đặt
        ->where('orders.id', $id)
        ->select('orders.*', 'users.name as user_name')  // Chọn tên người dùng (tên người đặt)
        ->first();

    // Kiểm tra xem đơn hàng có tồn tại không
    if (!$order) {
        return redirect()->route('orders.index')->with('error', 'Order not found.');
    }

    // Truyền dữ liệu đến view
    return view('orders.edit', compact('order'));
}


    public function update(Request $request, $id)
    {
        DB::table('orders')->where('id', $id)->update([
            'total_price' => $request->total_price,
            'status' => $request->status,
            'updated_at' => now(),
        ]);
    
        return redirect()->route('orders.index')->with('success', 'Cập nhật đơn hàng thành công.');
    }
    

    public function destroy($id)
    {
        DB::table('orders')->where('id', $id)->delete();
        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xoá.');
    }
}
