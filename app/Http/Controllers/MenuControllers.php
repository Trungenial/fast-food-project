<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
    
    
}
