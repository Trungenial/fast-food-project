@extends('layouts.app')
@section('title', 'Thể loại')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Categories</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Category
        </a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="card">
        <div class="card-body">
            @if($categories->count())
                <ul class="list-group">
                    @foreach ($categories as $category)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <button class="btn btn-sm btn-outline-secondary me-2" data-bs-toggle="collapse" data-bs-target="#children-{{ $category->id }}">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <strong>{{ $category->name }}</strong>
                            </div>
                            <div>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                        @if($category->children->count())
                            <ul id="children-{{ $category->id }}" class="collapse list-group ms-4 mt-2">
                                @foreach ($category->children as $child)
                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="font-size: 0.875rem;">
                                        <span>- {{ $child->name }}</span>
                                        <div>
                                            <a href="{{ route('categories.edit', $child->id) }}" class="btn btn-xs btn-warning me-1" style="font-size: 0.75rem;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $child->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger" style="font-size: 0.75rem;" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </ul>
            @else
                <p class="text-center text-muted">No categories found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
