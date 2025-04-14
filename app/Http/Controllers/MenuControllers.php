<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MenuControllers extends Controller
{
    function menu()
    {
        // Lấy danh sách sản phẩm
        $data = DB::select("SELECT * FROM products");

        // Lấy danh sách ảnh từ thư mục storage/app/public/items/
        $files = Storage::disk('public')->files('items');

        // Chỉ lấy file PNG, JPG, JPEG
        $images = array_filter($files, function ($file) {
            return preg_match('/\.(png|jpe?g)$/i', $file);
        });

        // Trả dữ liệu về view
        return view("pages.menu", compact("data", "images"));
    }
    public function index()
    {
        $categories = DB::table('categories')->get();
        $data = DB::table('products')->get();

        return view('pages.menu', compact('categories', 'data'));
    }

    public function category($id)
    {
        $categories = DB::table('categories')->get();
        $data = DB::table('products')->where('category_id', $id)->get();

        return view('pages.menu', compact('categories', 'data'));
    }

    public function cartadd(Request $request)
    {
        $id = $request->input('id');
        $num = (int) $request->input('num', 1); // đảm bảo kiểu số nguyên

        // Lấy giỏ hàng từ session hoặc tạo mới
        $cart = session()->get('cart', []);

        // Cộng dồn hoặc thêm mới
        if (array_key_exists($id, $cart)) {
            $cart[$id] += $num;
        } else {
            $cart[$id] = $num;
        }

        // Lưu lại vào session
        session(['cart' => $cart]);

        // Trả về số lượng tổng sản phẩm trong giỏ (đúng logic badge)
        return response()->json([
            'status' => 'success',
            'count' => array_sum($cart), // Tổng số lượng sản phẩm
        ]);
    }
    public function order()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return view('pages.order', ['items' => [], 'total' => 0]);
        }

        $productIds = array_keys($cart);

        $products = DB::table('products')
            ->whereIn('id', $productIds)
            ->get();

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

        return view('pages.order', compact('items', 'total'));
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
    public function ordercreate(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) return back()->with('error', 'Giỏ hàng trống!');

        $method = $request->input('method', 'cash'); // lấy phương thức thanh toán

        $productIds = array_keys($cart);
        $products = DB::table('products')->whereIn('id', $productIds)->get();

        $total = 0;
        foreach ($products as $product) {
            $quantity = $cart[$product->id] ?? 0;
            $total += $product->price * $quantity;
        }

        // Tạo đơn hàng
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'processing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Thêm chi tiết từng sản phẩm
        foreach ($products as $product) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $product->id,
                'quantity' => $cart[$product->id] ?? 0,
                'price' => $product->price,
            ]);
        }

        // Thêm bản ghi thanh toán
        DB::table('payments')->insert([
            'order_id' => $orderId,
            'method' => $method,
            'status' => $method === 'cash' ? 'paid' : 'pending',
            'transaction_id' => null,
            'created_at' => now(),
        ]);

        session()->forget('cart');

        return redirect()->route('myorders')->with('status', 'Đặt hàng thành công!');
    }


    public function myOrders()
    {
        $orders = DB::table('orders')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        foreach ($orders as $order) {
            $order->items = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->where('order_items.order_id', $order->id)
                ->select('products.name', 'order_items.quantity', 'order_items.price')
                ->get();
        }

        return view('pages.myorders', compact('orders'));
    }
}
