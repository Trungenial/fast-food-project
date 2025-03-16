@extends('layouts.app')
@section('title', 'Sản phẩm')
@section('content')
<div class="container">
    <h2 class="mb-4">📦 Danh sách sản phẩm</h2>

    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">
        ➕ Thêm sản phẩm
    </a>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark text-center">
                <tr>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Thể loại</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                @foreach ($products as $product)
                <tr>
                    <td><strong>{{ $product->name }}</strong></td>
                    <td>{{ $product->description }}</td>
                    <td><span class="text-success fw-bold">{{ number_format($product->price, 0) }} đ</span></td>
                    <td><span class="badge bg-primary">{{ $product->category->name }}</span></td>
                    <td>
                        <img src="{{ asset('storage/' . $product->image) }}" width="60" class="rounded border shadow-sm">
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                            ✏️ Sửa
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                🗑️ Xóa
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
