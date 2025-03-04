<!-- component -->
<!DOCTYPE html>
<html class="border-l" lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
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
    <div class="lg:col-span-2 col-span-3 bg-indigo-50 space-y-8 px-12">
        <div class="mt-8 p-4 relative flex flex-col sm:flex-row sm:items-center bg-white shadow rounded-md">
            <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                <div class="text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 sm:w-5 h-6 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="text-sm font-medium ml-3">Checkout</div>
            </div>
            <div class="text-sm tracking-wide text-gray-500 mt-4 sm:mt-0 sm:ml-4">Complete your shipping details below.</div>
            <div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                <a href="/products" class="submit-button px-4 py-1 rounded-full bg-pink-400 text-white focus:ring focus:outline-none w-full text-xl font-semibold transition-colors">
                    Back to Home
                </a>
            </div>
        </div>
        <div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-800 shadow rounded-2xl ">
            <form id="payment-form" method="POST" action="/pay">
                @csrf
                <section>
                    <h2 class="uppercase tracking-widest text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6 text-center">
                        Shipping Information
                    </h2>
                    <fieldset class="space-y-6">
                        <!-- Street Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Street Address
                            </label>
                            <input type="text" name="billing_address"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   placeholder="123 Main St">
                        </div>

                        <!-- City, State, ZIP -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    City
                                </label>
                                <input type="text" name="billing_city"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                       placeholder="City">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    State
                                </label>
                                <input type="text" name="billing_state"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                       placeholder="State">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    ZIP Code
                                </label>
                                <input type="text" name="billing_zip"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                       placeholder="ZIP">
                            </div>
                        </div>

                        <!-- Country -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Country
                            </label>
                            <select name="country"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition cursor-pointer">
                                <option value="AU">Australia</option>
                                <option value="BE">Belgium</option>
                                <option value="BR">Brazil</option>
                                <option value="CA">Canada</option>
                                <option value="CN">China</option>
                                <option value="DK">Denmark</option>
                                <option value="FI">Finland</option>
                                <option value="FR">France</option>
                                <option value="DE">Germany</option>
                                <option value="HK">Hong Kong</option>
                                <option value="IE">Ireland</option>
                                <option value="IT">Italy</option>
                                <option value="JP">Japan</option>
                                <option value="LU">Luxembourg</option>
                                <option value="MX">Mexico</option>
                                <option value="NL">Netherlands</option>
                                <option value="PL">Poland</option>
                                <option value="PT">Portugal</option>
                                <option value="SG">Singapore</option>
                                <option value="ES">Spain</option>
                                <option value="TN">Tunisia</option>
                                <option value="GB">United Kingdom</option>
                                <option value="US" selected="selected">United States</option>
                            </select>
                        </div>
                    </fieldset>
                </section>
                <br>
                <input type="hidden" name="finalAmount" value="{{ $TotalPrice }}">
                <button type="submit" class="px-4 py-3 rounded-full bg-pink-400 text-white focus:outline-none w-full text-xl font-semibold transition-colors">
                    Pay ${{ number_format($TotalPrice, 2, ',', ' ') }}
                </button>
            </form>
        </div>


    </div>
    <div class="col-span-1 bg-white lg:block hidden">
        <h1 class="py-6 border-b-2 text-xl text-gray-600 px-8">Order Summary</h1>
        <ul class="py-6 border-b space-y-6 px-8">
            @foreach($OrderedProducts as $Product)
                <li class="grid grid-cols-6 gap-2 border-b-1">
                    <div class="col-span-1 self-center">
                        <img src="{{ url('/storage/' . $Product[0]->image) }}" alt="Product" class="rounded w-full">
                    </div>
                    <div class="flex flex-col col-span-3 pt-2">
                        <span class="text-gray-600 text-md font-semi-bold">{{ $Product[0]->title }}</span>
                        <span class="text-gray-400 text-sm inline-block pt-2">{{ $Product[0]->subcategory->name }}</span>
                    </div>
                    <div class="col-span-2 pt-3">
                        <div class="flex items-center space-x-2 text-sm justify-between">
                            <span class="text-gray-400">${{ $Product[1] }} x ${{ $Product[0]->price }}</span>
                            <span class="text-pink-400 font-semibold inline-block">${{  number_format($Product[1] * $Product[0]->price, 2, ',', ' ') }}</span>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="px-8 border-b">
            <div class="flex justify-between py-4 text-gray-600">
                <span>Subtotal</span>
                <span class="font-semibold text-pink-500">${{ number_format($TotalPrice, 2, ',', ' ') }}</span>
            </div>
            <div class="flex justify-between py-4 text-gray-600">
                <span>Shipping</span>
                <span class="font-semibold text-pink-500">Free</span>
            </div>
        </div>
        <div class="font-semibold text-xl px-8 flex justify-between py-8 text-gray-600">
            <span>Total</span>
            <span>${{ number_format($TotalPrice, 2, ',', ' ') }}</span>
        </div>
    </div>
</div>
</body>
</html>
