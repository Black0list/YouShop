@extends('welcome')
@section('view')
    <section class="py-24 bg-white">
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
            <div class="main-data p-8 sm:p-14 bg-gray-50 rounded-3xl">
                <h2 class="text-center font-manrope font-semibold text-4xl text-black mb-16">Order History</h2>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-lg font-semibold text-indigo-600">Product</th>
                                <th class="px-6 py-4 text-lg font-semibold text-gray-600 text-center">Quantity x Price</th>
                                <th class="px-6 py-4 text-lg font-semibold text-gray-600 text-center">Total Price</th>
                            </tr>
                        </thead>
                        @foreach($items as $item)
                            <tbody>
                            <!-- Example row -->
                            <tr class="border-b hover:bg-indigo-50 transition">
                                <td class="flex items-center gap-4 px-6 py-6">
                                    <img src="{{ url('storage/'.$item->product->image) }}" alt="earbuds image" class="w-20 h-20 rounded-xl object-cover">
                                    <div>
                                        <h5 class="font-manrope font-semibold text-xl text-black">{{ $item->product->title }}</h5>
                                        <p class="text-gray-600 text-base">{{ $item->product->subcategory->name }}</p>
                                    </div>
                                </td>
                                <td class="text-center px-6 py-6">
                                    <p class="font-semibold text-xl text-black">{{ $item->quantity }} x ${{ $item->product->price }}</p>
                                </td>
                                <td class="text-center px-6 py-6">
                                    <p class="font-semibold text-xl text-indigo-600">${{ number_format($item->price, 2, ',', ' ') }}</p>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection
