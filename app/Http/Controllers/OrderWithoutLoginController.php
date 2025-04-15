<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderWithoutLoginController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders_without_login')->orderBy('created_at', 'desc')->paginate(10);
        return view('orders_without_login.index', compact('orders'));
    }

    public function show($id)
    {
        $order = DB::table('orders_without_login')->where('id', $id)->first();
        if (!$order) {
            abort(404);
        }
        return view('orders_without_login.show', compact('order'));
    }

    public function edit($id)
    {
        $order = DB::table('orders_without_login')->where('id', $id)->first();
        if (!$order) {
            abort(404);
        }
        return view('orders_without_login.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:150',
            'note' => 'nullable|string',
            'delivery_method' => 'required|in:home,store',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'districts' => 'nullable|string|max:100',
            'wards' => 'nullable|string|max:100',
            'full_address' => 'nullable|string',
            'store_id' => 'nullable|string|max:100',
            'order_note' => 'nullable|string',
            'status' => 'required|in:pending,paid,processing,completed,canceled',
            'time_pickup' => 'nullable|date',
        ]);

        DB::table('orders_without_login')->where('id', $id)->update(array_merge(
            $validated,
            ['updated_at' => now()]
        ));

        return redirect()->route('orders_without_login.index')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('orders_without_login')->where('id', $id)->delete();
        return redirect()->route('orders_without_login.index')->with('success', 'Order deleted successfully.');
    }
}
