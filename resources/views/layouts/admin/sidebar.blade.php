<div class="d-flex flex-column h-100">
    <div class="p-3 border-bottom border-secondary">
        <h3 class="h4 text-center mb-0">Admin Panel</h3>
    </div>
    <ul class="nav flex-column p-3">
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'bg-secondary rounded' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->routeIs('categories.*') ? 'bg-secondary rounded' : '' }}"
                href="{{ route('categories.index') }}">
                <i class="fas fa-list me-2"></i>Categories
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ request()->routeIs('products.*') ? 'bg-secondary rounded' : '' }}"
                href="{{ route('products.index') }}">
                <i class="fas fa-box me-2"></i>Products
            </a>
        </li>
    </ul>
</div>
