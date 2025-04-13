<div class="sidebar bg-dark">
    <div class="sidebar-header">
        <h3 class="text-light text-center py-3">Admin Panel</h3>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('categories.index') }}">
                Categories
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('products.index') }}">
                Products
            </a>
        </li>
    </ul>
</div>
