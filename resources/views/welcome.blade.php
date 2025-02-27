<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouShop - Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<!-- Navbar -->
<nav class="bg-gray-900 text-white shadow-md py-4">
    <div class="container mx-auto flex justify-between items-center px-6">
        <a href="/" class="text-xl font-bold text-blue-400">YouShop</a>
        <div class="flex space-x-6">
            <a href="/products" class="hover:text-blue-400 transition">Catalogue</a>
            <a href="#" id="cartButton" class="hover:text-blue-400 transition">Cart</a>
        </div>
        <div class="flex items-center space-x-4">
            @auth
                <div class="relative">
                    <button id="userMenuButton" class="text-white font-semibold focus:outline-none">
                        Hello, {{ Auth::user()->name ?? 'Guest' }}
                    </button>
                    <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-700 rounded-lg shadow-lg py-2">
                        <a href="/profile" class="block px-4 py-2 text-white hover:bg-gray-600">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-white hover:bg-gray-600">
                                Log Out
                            </button>
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

<!-- Cart Sidebar -->
<div id="cart" class="fixed inset-0 overflow-hidden z-10 hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div class="pointer-events-auto w-screen max-w-md">
                    <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                        <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping cart</h2>
                                <div class="ml-3 flex h-7 items-center">
                                    <button type="button" id="closeCart" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500">
                                        <span class="absolute -inset-0.5"></span>
                                        <span class="sr-only">Close panel</span>
                                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-8">
                                <div class="flow-root">
                                    <ul role="list" id="items" class="-my-6 divide-y divide-gray-200">
                                        <!-- More products... -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Subtotal</p>
                                <div class="flex">
                                    <span>$</span>
                                    <span id="totalAmount">0</span>
                                </div>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                            <div class="mt-6">
                                <a href="#" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-xs hover:bg-indigo-700">Checkout</a>
                            </div>
                            <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                <p>
                                    or
                                    <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Continue Shopping
                                        <span aria-hidden="true"> &rarr;</span>
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Contenu principal -->
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">@yield('title')</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @yield('content')
    </div>
    <div>@yield('view')</div>
</div>

<!-- Script JS -->
<script>
    document.getElementById("cartButton").addEventListener("click", function (event) {
        event.preventDefault();

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let cart = document.getElementById("cart");
        cart.classList.toggle("hidden");

        itemsSection = document.getElementById('items');
        items = JSON.parse(localStorage.getItem('products'));
        fetch('/products/get', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(items)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                itemsSection.innerHTML = '';
                let Total = 0;
                console.log(items)
                for (let i = 0; i < items.length; i++)
                {
                    itemsSection.innerHTML += `<li class="flex py-6">
                      <div class="size-24 shrink-0 overflow-hidden rounded-md border border-gray-200">
                        <img src="/storage/${data['products'][i].image}" alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." class="size-full object-cover">
                      </div>

                      <div class="ml-4 flex flex-1 flex-col">
                        <div>
                          <div class="flex justify-between text-base font-medium text-gray-900">
                            <h3>
                              <a href="#">${data['products'][i].title}</a>
                            </h3>
                            <p class="ml-4">$${data['products'][i].price} x${data['products'][i].quantity}</p>
                          </div>
                        </div>
                        <div class="flex flex-1 items-end justify-between text-sm">
                          <p class="text-gray-500">${data['products'][i].quantity}</p>

                          <div class="flex">
                            <button type="button" data-id="${data['products'][i].id}" class="font-medium text-indigo-600 hover:text-indigo-500 removeTag">Remove</button>
                          </div>
                        </div>
                      </div>
                    </li>`

                    Total += data['products'][i].price * data['products'][i].quantity || 0;
                }

                totalSpan = document.getElementById('totalAmount');
                totalSpan.textContent = Total;

                document.querySelectorAll(".removeTag").forEach(function(element) {
                    element.addEventListener("click", function (event) {
                        for(let i = 0; i < items.length;i++)
                        {
                            if(items[i].product === element.getAttribute('data-id'))
                            {
                                event.stopPropagation();
                                event.currentTarget.closest('li').remove();
                                items.splice(i, 1);
                            }
                        }
                        localStorage.setItem('products', JSON.stringify(items));
                        Total = 0;
                        items.forEach((element, index) => {
                            Total += element.price * element.quantity;
                        })
                        totalSpan.textContent = Total;
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });



    });

    document.getElementById("closeCart").addEventListener("click", function () {
        document.getElementById("cart").classList.add("hidden");
    });

    document.getElementById("userMenuButton").addEventListener("click", function (event) {
        event.stopPropagation();
        document.getElementById("userMenu").classList.toggle("hidden");
    });

    document.addEventListener("click", function (event) {
        let menu = document.getElementById("userMenu");
        let button = document.getElementById("userMenuButton");
        let cart = document.getElementById("cart");
        let cartButton = document.getElementById("cartButton");
        let closeCart = document.getElementById("closeCart");

        if (!button.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.add("hidden");
        }

        if (!cartButton.contains(event.target) && !cart.contains(event.target) && event.target !== closeCart) {
            cart.classList.add("hidden");
        }
    });



</script>

</body>
</html>
