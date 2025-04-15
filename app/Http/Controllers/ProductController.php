<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10); // mỗi trang 10 sản phẩm
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Xử lý file ảnh
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->storeAs('items', $fileName, 'public'); // Lưu file vào storage/app/public/items/
    } else {
        $fileName = null;
    }

    // Lưu vào database
    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'image' => $fileName, // Lưu tên file vào database
    ]);

    return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm!');
}



    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Xử lý file ảnh
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = time() . '-' . $file->getClientOriginalName();

        // Xóa ảnh cũ (nếu có)
        if ($product->image && Storage::disk('public')->exists('items/' . $product->image)) {
            Storage::disk('public')->delete('items/' . $product->image);
        }

        // Lưu ảnh mới
        $file->storeAs('items', $fileName, 'public');
    } else {
        $fileName = $product->image; // Giữ ảnh cũ nếu không có ảnh mới
    }

    // Cập nhật database
    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'image' => $fileName,
    ]);

    return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật!');
}




    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã bị xóa!');
    }
    
}
