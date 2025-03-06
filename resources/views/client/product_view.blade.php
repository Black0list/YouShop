@extends('welcome')
{{--@section('title', 'Product View')--}}
@section('view')

    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Product Header -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 bg-white shadow-2xl rounded-3xl p-8">
            <div class="relative">
                <img class="w-full h-96 object-cover rounded-3xl shadow-lg border" src="{{ url('storage/'.$product->image) }}" alt="{{ $product->title }}">
                <span class="absolute top-4 left-4 bg-indigo-600 text-white px-4 py-1 text-sm rounded-full shadow">In Stock: {{ $product->stock }}</span>
            </div>
            <div class="flex flex-col justify-between">
                <div>
                    <h1 class="text-4xl font-extrabold text-gray-800 mb-4"><strong>Title : </strong>{{ $product->title }}</h1>
                    <div class="flex items-center gap-4 text-gray-600 mb-2">
                        <i class="bi bi-tags-fill text-indigo-500"></i><strong>SubCategory : </strong>{{ $product->subcategory->name }}
                    </div>
                    <div class="flex items-center gap-4 text-gray-600">
                        <i class="bi bi-card-text text-indigo-500"></i><strong>Category : </strong>{{ $product->subcategory->category->name }}
                    </div>
                    <p class="mt-6 text-lg text-gray-700 leading-relaxed"><strong>Description : </strong>{{ $product->description }}</p>
                </div>

                <div class="mt-8 bg-gray-100 p-6 rounded-2xl">
                    <div class="text-3xl font-bold text-indigo-600 mb-4">$<span id="price">{{ $product->price }}</span></div>

                    <div class="flex items-center gap-4 mb-6">
                        <label for="quantity" class="font-medium text-lg">Quantity:</label>
                        <div class="flex items-center border rounded-lg overflow-hidden">
                            <button id="decrease" class="px-4 py-2 bg-gray-200 hover:bg-gray-300">-</button>
                            <input id="quantity" type="text" value="1" class="w-12 text-center bg-white border-none focus:outline-none" disabled>
                            <input type="hidden" id="product" value="{{ $product->id }}">
                            <button id="increase" class="px-4 py-2 bg-gray-200 hover:bg-gray-300">+</button>
                        </div>
                    </div>

                    <button id="BuyBtn" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-lg font-semibold flex items-center justify-center gap-2 transition-all">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                </div>

                <div class="mt-8 grid grid-cols-2 gap-4 text-gray-700 text-sm">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-truck text-green-600"></i> Fast Delivery
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="bi bi-credit-card text-green-600"></i> Secure Payments
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="bi bi-award text-green-600"></i> 30 Days Warranty
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="bi bi-shield-lock text-green-600"></i> Buyer Protection
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-6 right-6 bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg hidden">
        Added to cart successfully!
    </div>

    <script>
        const quantityInput = document.getElementById('quantity');
        const priceElement = document.getElementById('price');
        const productPrice = {{ $product->price }};
        const maxStock = {{ $product->stock }};

        document.getElementById('increase').onclick = () => {
            let value = parseInt(quantityInput.value);
            if (value < maxStock) {
                value++;
                quantityInput.value = value;
                priceElement.textContent = (productPrice * value).toFixed(2);
            }
        };

        document.getElementById('decrease').onclick = () => {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                value--;
                quantityInput.value = value;
                priceElement.textContent = (productPrice * value).toFixed(2);
            }
        };

        document.getElementById('BuyBtn').onclick = () => {
            const quantity = parseInt(quantityInput.value);
            const product = document.getElementById("product").value;
            let products = JSON.parse(localStorage.getItem('products') || '[]');
            const existing = products.find(p => p.product === product);

            if (existing) {
                existing.quantity = quantity;
            } else {
                products.push({ product, quantity, price: productPrice });
            }

            localStorage.setItem('products', JSON.stringify(products));

            const toast = document.getElementById('toast');
            toast.classList.remove('hidden');
            toast.classList.add('animate-bounce');
            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('animate-bounce');
            }, 3000);
        };
    </script>
@endsection
