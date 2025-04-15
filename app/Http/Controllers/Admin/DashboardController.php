<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Tổng doanh thu
        $totalRevenue = DB::table('orders')->sum('total_price');

        // Tổng đơn hàng
        $totalOrders = DB::table('orders')->count();

        // Tổng số người dùng
        $totalUsers = DB::table('users')->count();

        // Doanh thu theo tháng
        $monthlyRevenue = DB::table('orders')
            ->selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Top 5 sản phẩm bán chạy
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(order_items.quantity) as total'))
            ->groupBy('products.name')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'products.name');

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalUsers',
            'monthlyRevenue',
            'topProducts'
        ));
    }
}
