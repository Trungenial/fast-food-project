<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="d-flex min-vh-100">
        <!-- Sidebar -->
        <div class="bg-dark text-white" style="width: 250px;">
            @include('layouts.admin.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1" style="max-width: 90%">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
                @include('layouts.admin.navbar')
            </nav>

            <!-- Content -->
            <div class="container-fluid p-4">
                @yield('content')
                @yield('scripts')
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
