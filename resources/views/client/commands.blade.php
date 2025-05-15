<!DOCTYPE html>
<html class="border-l" lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        fieldset label span {
            min-width: 125px;
        }
        fieldset .select::after {
            content: '';
            position: absolute;
            width: 9px;
            height: 5px;
            right: 20px;
            top: 50%;
            margin-top: -2px;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='9' height='5' viewBox='0 0 9 5'><title>Arrow</title><path d='M.552 0H8.45c.58 0 .723.359.324.795L5.228 4.672a.97.97 0 0 1-1.454 0L.228.795C-.174.355-.031 0 .552 0z' fill='%23CFD7DF' fill-rule='evenodd'/></svg>");
            pointer-events: none;
        }
    </style>
</head>
<body>

<div class="h-screen grid grid-cols-3">
    <div class="lg:col-span-2 col-span-3 bg-gray-100 space-y-8 px-12">
        <div class="mt-8 p-4 relative flex flex-col sm:flex-row sm:items-center bg-white shadow rounded-md">
            <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                <div class="text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 sm:w-5 h-6 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="text-sm font-medium ml-3 text-gray-900">Checkout</div>
            </div>
            <div class="text-sm tracking-wide text-gray-500 mt-4 sm:mt-0 sm:ml-4">Complete your shipping details below.</div>
            <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                <form action="/command/cancel" method="POST">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="command" value="{{ $command->id }}">
                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
        <div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-800 shadow rounded-2xl ">
            <form id="payment-form" method="POST" action="/pay">
                @csrf
                <section>
                    <h2 class="uppercase tracking-widest text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">
                        Shipping Information
                    </h2>
                    <fieldset class="space-y-6">
                        <!-- Street Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Street Address
                            </label>
                            <input type="text" name="address"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 ease-in-out"
{{--                                   placeholder="123 Main St" value="{{ Auth::user()->address->address }}">--}}
                        </div>

                        <!-- City, State, ZIP -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    City
                                </label>
                                <input type="text" name="city"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 ease-in-out"
{{--                                       placeholder="City" value="{{ Auth::user()->address->city }}">--}}
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    State
                                </label>
                                <input type="text" name="state"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 ease-in-out"
{{--                                       placeholder="State" value="{{ Auth::user()->address->state }}">--}}
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ZIP
                                </label>
                                <input type="number"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 ease-in-out"
                                       placeholder="ZIP" name="postal_code" value="">
                            </div>
                        </div>

                        <!-- Country -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Country
                            </label>
                            <input type="text"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-300 ease-in-out"
                                   placeholder="US" name="country" value="">
                        </div>
                    </fieldset>
                </section>
                <br>
                <input type="hidden" name="finalAmount" value="{{ $total_price }}">
                <button type="submit" class="px-4 py-3 rounded-full bg-green-600 text-white focus:outline-none w-full text-xl font-semibold transition duration-300 ease-in-out hover:bg-green-500" @if(is_null($Products)) disabled @endif>
                    Pay ${{ number_format($total_price, 2, ',', ' ') }}
                </button>
            </form>
        </div>
    </div>
    <div class="col-span-1 bg-white lg:block hidden">
        <h1 class="py-6 border-b-2 text-xl text-gray-600 px-8">Order Summary</h1>
        <ul class="py-6 border-b space-y-6 px-8">
            @if(!is_null($Products))
                @foreach($Products as $Product)
                    <li class="grid grid-cols-6 gap-2 border-b-1">
                        <div class="col-span-1 self-center">
                            <img src="{{ url('/storage/' . $Product->product->image) }}" alt="Product" class="rounded w-full">
                        </div>
                        <div class="flex flex-col col-span-3 pt-2">
                            <span class="text-gray-600 text-md font-semi-bold">{{ $Product->product->title }}</span>
                            <span class="text-gray-400 text-sm inline-block pt-2">{{ $Product->product->subcategory->name }}</span>
                        </div>
                        <div class="col-span-2 pt-3">
                            <div class="flex items-center space-x-2 text-sm justify-between">
                                <span class="text-gray-400">${{ $Product->quantity }} x ${{ $Product->product->price }}</span>
                                <span class="text-orange-500 font-semibold inline-block">${{  number_format($Product->quantity * $Product->product->price, 2, ',', ' ') }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            @else
                <li class="">
                    No Products
                </li>
            @endif
        </ul>
        <div class="px-8 border-b">
            <div class="flex justify-between py-4 text-gray-600">
                <span>Subtotal</span>
                <span class="font-semibold text-green-600">${{ number_format($total_price, 2, ',', ' ') }}</span>
            </div>
            <div class="flex justify-between py-4 text-gray-600">
                <span>Shipping</span>
                <span class="font-semibold text-green-600">Free</span>
            </div>
        </div>
        <div class="font-semibold text-xl px-8 flex justify-between py-8 text-gray-600">
            <span>Total</span>
            <span class="text-green-600">${{ number_format($total_price, 2, ',', ' ') }}</span>
        </div>
    </div>
</div>
</body>
</html>
