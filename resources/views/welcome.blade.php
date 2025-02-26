<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouShop - Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<!-- Navbar -->
<nav class="bg-gray-900 text-white shadow-md py-4">
    <div class="container mx-auto flex justify-between items-center px-6">
        <!-- Logo -->
        <a href="/" class="text-xl font-bold text-blue-400">YouShop</a>

        <!-- Section centrale -->
        <div class="flex space-x-6">
            <a href="/products" class="hover:text-blue-400 transition">Catalogue</a>
            <a href="#" class="hover:text-blue-400 transition">Panier</a>
        </div>

        <!-- Section utilisateur -->
        <div class="flex items-center space-x-4">
            @auth
                <div class="relative">
                    <button id="userMenuButton" class="text-white font-semibold focus:outline-none">Hello, {{ Auth::user()->name ?? 'Guest' }}</button>
                    <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-700 rounded-lg shadow-lg py-2">
                        <a href="/profile" class="block px-4 py-2 text-white hover:bg-gray-600">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="nav-link">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                                   onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Connexion</a>
                <a href="{{ route('register') }}" class="px-4 py-2 border border-blue-400 text-blue-400 rounded-lg hover:bg-blue-500 hover:text-white transition">Inscription</a>
            @endauth
        </div>
    </div>
</nav>


<!-- Catalogue de produits -->
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">@yield('title')</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @yield('content')
    </div>
    <div>
        @yield('view')
    </div>
</div>

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
