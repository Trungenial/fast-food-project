@extends('layouts.admin')
@section('title', 'Chỉnh sửa danh mục')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Chỉnh sửa danh mục</h2>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên danh mục</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $category->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Danh mục cha (Tùy chọn)</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">Không có</option>
                            @foreach ($categories as $parentCategory)
                                @if ($parentCategory->parent_id == null && $parentCategory->id != $category->id)
                                    <!-- Chỉ hiển thị danh mục cha và loại trừ chính nó -->
                                    <option value="{{ $parentCategory->id }}"
                                        {{ $category->parent_id == $parentCategory->id ? 'selected' : '' }}>
                                        {{ $parentCategory->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
                </form>
            </div>
        </div>
    </div>
@endsection
