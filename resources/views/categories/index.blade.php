@extends('layouts.admin')
@section('title', 'Thể loại')
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">📁 Danh sách thể loại</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                ➕ Thêm thể loại
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Tên</th>
                        <th>Thể loại con</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody class="text-center align-middle">
                    @forelse ($categories as $category)
                        <tr>
                            <td><strong>{{ $category->name }}</strong></td>
                            <td>
                                @if ($category->children->count())
                                    @foreach ($category->children as $child)
                                        <span class="badge bg-secondary mb-1">{{ $child->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">Không có</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">✏️
                                    Sửa</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Bạn có chắc chắn muốn xoá?')">🗑️ Xoá</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted">Không có thể loại nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Phân trang --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
