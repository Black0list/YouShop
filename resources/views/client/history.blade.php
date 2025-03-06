@extends('welcome')
@section('view')
    <section class="py-24 bg-[#f3f4f6]">
        <div class="max-w-6xl mx-auto px-4 md:px-8">
            <div class="bg-[#1e293b] shadow-xl rounded-2xl p-10 sm:p-14">
                <h2 class="text-center font-manrope font-bold text-3xl text-white flex items-center justify-center gap-3 mb-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-[#38bdf8]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.2 6M7 13l1.2 6M17 13l1.2 6M9 21h6" />
                    </svg>
                    Orders History
                </h2>

                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-[#38bdf8] uppercase tracking-wide">Order ID</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-400 uppercase tracking-wide">Total Price</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-400 uppercase tracking-wide">Status</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-400 uppercase tracking-wide">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                        @forelse($commands as $command)
                            <tr class="hover:bg-[#334155] transition">
                                <td class="px-4 py-5 text-white font-medium">
                                    #{{ $command->id }}
                                </td>
                                <td class="text-center text-base font-semibold text-[#4ade80]">
                                    ${{ number_format($command->total_price, 2, '.', ',') }}
                                </td>
                                <td class="text-center px-4 py-5">
                                    @if($command->status === 'delivered')
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-300">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Delivered
                                        </span>
                                    @elseif($command->status === 'shipped')
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                                            </svg>
                                            Shipped
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-medium bg-rose-100 text-rose-800 dark:bg-rose-900 dark:text-rose-300">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                                            </svg>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center px-4 py-5">
                                    <a href="/command/view/{{ $command->id }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#38bdf8] hover:bg-[#0ea5e9] rounded-lg transition">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-12 text-gray-500 text-base">
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

                <div class="mt-8">
                    {{ $commands->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
