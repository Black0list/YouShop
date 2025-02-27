@extends('welcome')
@section('title', 'Product View')
@section('view')

    <div class="max-w-8xl">
        <!-- Product Header -->
        <div class="bg-white p-8 rounded-xl shadow-xl mb-8 flex flex-col md:flex-row justify-between items-center border border-gray-200">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-800">
                    {{ $product->title }}
                </h1>
                <div class="mt-4">
                    <div class="flex items-center text-gray-600 space-x-2">
                        <i class="bi bi-tags-fill text-indigo-500 text-lg"></i>
                        <span class="font-semibold text-lg">{{ $product->subcategory->name }}</span>
                    </div>
                    <div class="flex items-center text-gray-600 space-x-2 mt-2">
                        <i class="bi bi-card-text text-indigo-500 text-lg"></i>
                        <span class="font-medium text-lg">{{ $product->subcategory->category->name }}</span>
                    </div>
                </div>
            </div>
            <div>
                <img class="w-52 h-52 object-cover rounded-xl shadow-md border border-gray-300" src="{{ url('storage/'.$product->image) }}" alt="Product Image">
            </div>
        </div>

        <!-- Product Details Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2">
                <div class="bg-white p-8 rounded-xl shadow-md border border-gray-200">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800 flex items-center">
                        <i class="bi bi-info-circle-fill text-indigo-500 mr-2"></i> Product Details
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        {{ $product->description }}
                    </p>
                    <div class="mt-6 flex items-center text-lg">
                        <i class="bi bi-box-seam text-green-600 text-xl mr-2"></i>
                        <span class="text-gray-700 font-semibold">Stock: </span>
                        <span class="text-green-600 font-bold ml-1">{{ $product->stock }}</span>
                    </div>
                </div>
            </div>

            <!-- Right Column - Purchase Section -->
            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-xl shadow-md border border-gray-200 sticky top-8">
                    <div class="text-4xl font-bold text-indigo-600 mb-6 flex items-center" >
                        <i class="bi bi-cash-coin mr-2 text-3xl"></i>$<span id="price">{{ $product->price }}</span>
                    </div>
                    <!-- Quantity Selector -->
                    <div class="mb-6">
                        <label for="quantity" class="block text-lg font-semibold text-gray-700">Quantity:</label>
                        <div class="flex items-center mt-2 border border-gray-300 rounded-lg overflow-hidden w-36">
                            <button id="decrease" class="bg-gray-200 px-4 py-2 text-lg font-bold hover:bg-gray-300">-</button>
                            <input type="text" id="quantity" value="1" class="w-full text-center text-lg font-semibold text-gray-700 bg-white border-none focus:outline-none" disabled>
                            <input type="hidden" id="product" value="{{ $product->id }}">
                            <button id="increase" class="bg-gray-200 px-4 py-2 text-lg font-bold hover:bg-gray-300">+</button>
                        </div>
                    </div>
                    <button id="BuyBtn" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition-all transform hover:scale-105 active:scale-95 flex items-center justify-center">
                        <i class="bi bi-cart-fill mr-2"></i>
                        add to cart
                    </button>
                    <div class="mt-6 space-y-3 text-gray-600">
                        <div class="flex items-center gap-4">
                            <i class="bi bi-truck text-green-600 text-xl"></i>
                            <span>Fast Delivery Available</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="bi bi-credit-card text-green-600 text-xl"></i>
                            <span>Secure Payments</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="bi bi-award text-green-600 text-xl"></i>
                            <span>30 Days Warranty</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <i class="bi bi-shield-lock text-green-600 text-xl"></i>
                            <span>100% Buyer Protection</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // document.getElementById('BuyBtn').addEventListener('click', function(e) {
        //     const buyText = document.getElementById('buyText');
        //     const spinner = document.getElementById('spinner');
        //
        //     buyText.textContent = "Processing...";
        //     spinner.classList.remove('hidden');
        //
        //     setTimeout(() => {
        //         buyText.textContent = "Purchase Successful!";
        //         spinner.classList.add('hidden');
        //         document.getElementById('BuyBtn').classList.add('bg-green-600', 'hover:bg-green-700');
        //     }, 2000);
        // });

        const quantityInput = document.getElementById('quantity');
        document.getElementById('increase').addEventListener('click', function() {
            let value = parseInt(quantityInput.value);
            if (value < {{ $product->stock }}) {
                quantityInput.value = ++value;
                document.getElementById('price').textContent = {{ $product->price }} * value;
            }
        });

        document.getElementById('decrease').addEventListener('click', function() {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                lastQty = document.getElementById('quantity').value;
                lastPrice = document.getElementById('price').textContent;
                quantityInput.value = --value;
                newQty = document.getElementById('quantity').value;
                console.log(lastQty, lastPrice, newQty);
                document.getElementById('price').textContent = (newQty * lastPrice) / lastQty;
            }
        });
        //////////////////////////////////////////////////////// Dynamic

        document.getElementById("BuyBtn").addEventListener("click", function () {
            // localStorage.clear()
            let quantity = parseInt(document.getElementById("quantity").value);
            let product = document.getElementById("product").value;

            let products = localStorage.getItem('products') ? JSON.parse(localStorage.getItem('products')) : [];

            let existingProduct = products.find(item => item.product === product);

            if (existingProduct) {
                existingProduct.quantity = quantity;
            } else {
                products.push({ product: product, quantity: quantity });
            }

            localStorage.setItem('products', JSON.stringify(products));

            console.log(products);
        });



    </script>

@endsection
