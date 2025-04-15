<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê đơn hàng
        $ordersByDate = DB::table('orders')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $ordersByDate->pluck('date')->toArray();
        $data = $ordersByDate->pluck('total')->toArray();

        return view('admin.dashboard', compact('labels', 'data'));
    }
}
