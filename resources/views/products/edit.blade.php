@extends('layouts.admin')
@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
    <div class="container">
        <h2 class="mb-4">✏️ Chỉnh sửa sản phẩm</h2>

        <div class="card p-4 shadow-sm">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">📂 Thể loại sản phẩm:</label>
                    <select name="category_id" class="form-select" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">🏷️ Tên sản phẩm:</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">📝 Mô tả:</label>
                    <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">💰 Giá:</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">🖼️ Ảnh sản phẩm:</label>
                    <input type="file" name="image" class="form-control">
                    <div class="mt-2">
                        <img src="{{ asset('storage/items' . $product->image) }}" width="80">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">🔙 Quay lại</a>
                    <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection
