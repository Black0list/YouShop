@extends('welcome')
@section('view')
    <section class="py-24 bg-[#f3f4f6]">
        <div class="max-w-6xl mx-auto px-4 md:px-8">
            <div class="bg-[#1e293b] shadow-xl rounded-2xl p-10 sm:p-14">
                <h2 class="text-center font-manrope font-bold text-3xl text-white flex items-center justify-center gap-3 mb-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-[#38bdf8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.2 6M7 13l1.2 6M17 13l1.2 6M9 21h6" />
                    </svg>
                    Order History
                </h2>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-[#38bdf8] uppercase tracking-wide">Product</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-400 uppercase tracking-wide">Quantity × Price</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-400 uppercase tracking-wide">Total</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                        @forelse($items as $item)
                            <tr class="hover:bg-[#334155] transition">
                                <td class="flex items-center gap-4 px-4 py-5">
                                    <img src="{{ url('storage/'.$item->product->image) }}" alt="{{ $item->product->title }}" class="w-14 h-14 rounded-lg object-cover border border-gray-700">
                                    <div>
                                        <h5 class="font-medium text-base text-white">{{ $item->product->title }}</h5>
                                        <p class="text-sm text-gray-400">{{ $item->product->subcategory->name }}</p>
                                    </div>
                                </td>
                                <td class="text-center px-4 py-5">
                                <span class="text-base text-gray-300">
                                    {{ $item->quantity }} × ${{ number_format($item->product->price, 2, '.', ',') }}
                                </span>
                                </td>
                                <td class="text-center px-4 py-5">
                                <span class="text-base font-semibold text-[#4ade80]">
                                    ${{ number_format($item->price, 2, '.', ',') }}
                                </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-12 text-gray-500 text-base">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l-4-4m0 0l4-4m-4 4h12" />
                                        </svg>
                                        No orders found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection
