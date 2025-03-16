@extends('layouts.app')
@section('title', 'Thêm sản phẩm')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Thêm sản phẩm mới</h2>

    <div class="card p-4 shadow-sm">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">📂 Thể loại sản phẩm:</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Chọn thể loại</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">🏷️ Tên sản phẩm:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">📝 Mô tả:</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">💰 Giá:</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">🖼️ Ảnh sản phẩm:</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">🔙 Quay lại</a>
                <button type="submit" class="btn btn-success">✅ Thêm sản phẩm</button>
            </div>
        </form>
    </div>
</div>
@endsection
