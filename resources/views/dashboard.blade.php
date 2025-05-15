<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('failed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar vh-100% p-3 shadow">
            <div class="profile">
                <img src="https://randomuser.me/api/portraits/men/51.jpg" alt="Profile">
                <div class="name">
                    {{ Auth::user()->name }}
                </div>
            </div>
            <nav class="nav flex-column">
                <a href="/admin/stats" class="nav-link rounded mb-2" onclick="setActive(this)">
                    <i class="bi bi-house-door me-2"></i>Tableau de bord
                </a>
                <a href="/admin/users" class="nav-link mb-2" onclick="setActive(this)">
                    <i class="bi bi-briefcase me-2"></i>Users
                </a>
                <a href="/admin/roles" class="nav-link mb-2" onclick="setActive(this)">
                    <i class="bi bi-person-vcard-fill"></i>Roles
                </a>
                <a href="/admin/categories" class="nav-link mb-2" onclick="setActive(this)">
                    <i class="bi bi-tags me-2"></i>Categories
                </a>
                <a href="/admin/subcategories" class="nav-link mb-2" onclick="setActive(this)">
                    <i class="bi bi-tags me-2"></i>SubCategories
                </a>
                <a href="/admin/products" class="nav-link mb-2" onclick="setActive(this)">
                    <i class="bi bi-bag-plus-fill"></i>Products
                </a>
                <a href="/admin/commands" class="nav-link mb-2" onclick="setActive(this)">
                    <i class="bi bi-archive-fill"></i>Commands
                    <span class="badge bg-danger ms-2">3</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Tableau de bord</h1>
                <div class="relative">
                    <button id="userMenuButton" class=" font-semibold focus:outline-1">Hello, {{ Auth::user()->name ?? 'Guest' }}</button>
                    <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-700 rounded-lg shadow-lg py-2">
                        <a href="/profile" class="block px-4 py-2 font-semibold hover:bg-gray-600">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class='block px-4 py-2 cursor-pointer  hover:bg-gray-600'>
                            @csrf
                            <button class="text-red-500"><i class="bi bi-box-arrow-left"></i> {{ __('Log Out') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body  bg-body-secondary rounded">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!-- Toggle Dark Mode Button -->
<button class="toggle-mode" onclick="toggleDarkMode()">
    <i class="bi bi-moon"></i> Dark Mode
</button>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script>
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('dark-mode', document.body.classList.contains('dark-mode'));
    }

    document.addEventListener("DOMContentLoaded", () => {
        if (localStorage.getItem('dark-mode') === 'true') {
            document.body.classList.add('dark-mode');
        }

        const isDarkMode = localStorage.getItem("dark-mode") === "enabled";
        if (isDarkMode) {
            updateModalDarkMode(newDarkModeState);
        }

        document.getElementById("toggle-dark-mode").addEventListener("click", function () {
            document.querySelector(".modal-content").classList.toggle("bg-dark");
            document.querySelector(".modal-content").classList.toggle("text-white");

            localStorage.setItem("dark-mode",
                document.body.classList.contains("dark-mode") ? "enabled" : "disabled"
            );
        });
    });
</script>

<script>
    document.getElementById("userMenuButton").addEventListener("click", function (event) {
        event.stopPropagation();
        document.getElementById("userMenu").classList.toggle("hidden");
    });

    document.addEventListener("click", function (event) {
        let menu = document.getElementById("userMenu");
        let button = document.getElementById("userMenuButton");
        if (!button.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add("hidden");
        }
    });
</script>
</body>
</html>
