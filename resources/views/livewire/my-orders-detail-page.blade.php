<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl sm:text-3xl font-bold text-black">Detail Pesanan</h1>

    <!-- Grid Info -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
        <!-- Pelanggan -->
        <div class="flex flex-col bg-blue-100 border shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.403 4.209A2 2 0 0116.836 22H7.164a2 2 0 01-1.757-2.791L4 17h5m6-3V4a2 2 0 00-2-2H7a2 2 0 00-2 2v10m6 4V9" />
                    </svg>
                </div>
                <div class="grow">
                    <p class="text-xs uppercase tracking-wide text-black">Pelanggan</p>
                    <div class="mt-1">{{ $address->full_name }}</div>
                </div>
            </div>
        </div>

        <!-- Tanggal -->
        <div class="flex flex-col bg-blue-100 border shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 2H4a2 2 0 00-2 2v16a2 2 0 002 2h16a2 2 0 002-2V4a2 2 0 00-2-2zM4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
                <div class="grow">
                    <p class="text-xs uppercase tracking-wide text-black">Tanggal Pesanan</p>
                    <h3 class="text-lg font-medium text-black mt-1">{{ $order_items[0]->created_at->format('d-m-Y') }}</h3>
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="flex flex-col bg-blue-100 border shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18M3 21L21 3" />
                    </svg>
                </div>
                <div class="grow">
                    <p class="text-xs uppercase tracking-wide text-black">Status Pesanan</p>
                    <div class="mt-1">
                        @php
                            $status = match ($order->status) {
                                'new' => '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Baru</span>',
                                'processing'
                                    => '<span class="bg-yellow-500 py-1 px-3 rounded text-black shadow">Diproses</span>',
                                'shipped'
                                    => '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Dikirim</span>',
                                'delivered'
                                    => '<span class="bg-gray-700 py-1 px-3 rounded text-white shadow">Diterima</span>',
                                'cancelled'
                                    => '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Dibatalkan</span>',
                                default => '',
                            };
                        @endphp
                        {!! $status !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Pembayaran -->
        <div class="flex flex-col bg-blue-100 border shadow-sm rounded-xl">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a3 3 0 013-3h12a3 3 0 013 3v16a3 3 0 01-3 3H6a3 3 0 01-3-3V4z" />
                    </svg>
                </div>
                <div class="grow">
                    <p class="text-xs uppercase tracking-wide text-black">Status Pembayaran</p>
                    <div class="mt-1">
                        @php
                            $payment_status = match ($order->payment_status) {
                                'pending'
                                    => '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Menunggu</span>',
                                'paid'
                                    => '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Dibayar</span>',
                                'failed' => '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Gagal</span>',
                                default => '',
                            };
                        @endphp
                        {!! $payment_status !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="flex flex-col lg:flex-row gap-4 mt-6">
        <!-- Tabel Produk -->
        <div class="lg:w-3/4 w-full">
            <div class="bg-blue-100 rounded-lg shadow-md p-4 sm:p-6 mb-4 overflow-x-auto">
                <div class="min-w-[700px]">
                    <table class="w-full text-sm text-left whitespace-nowrap">
                        <thead>
                            <tr class="text-gray-600">
                                <th class="px-6 py-3 font-semibold text-left">Produk</th>
                                <th class="px-6 py-3 font-semibold text-left">Harga</th>
                                <th class="px-6 py-3 font-semibold text-center">Jumlah</th>
                                <th class="px-6 py-3 font-semibold text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_items as $item)
                                <tr wire:key="{{ $item->id }}" class="border-b last:border-0">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <!-- Ukuran Gambar diatur agar lebih proporsional -->
                                            <img class="h-12 w-12 rounded object-cover"
                                                src="{{ url('storage', $item->product->images[0]) }}"
                                                alt="{{ $item->product->name }}">
                                            <span class="font-medium text-gray-800">{{ $item->product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">Rp {{ number_format($item->unit_amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center">{{ $item->quantity }}</td>
                                    <td class="px-6 py-4 text-right">Rp {{ number_format($item->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            <!-- Alamat Pengiriman -->
            <div class="bg-blue-100 rounded-lg shadow-md p-6 mb-4">
                <h2 class="text-lg font-semibold text-slate-700 mb-3">Alamat Pengiriman</h2>
                <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                    <p>{{ $address->street_address }}, {{ $address->city }}, {{ $address->state }},
                        {{ $address->zip_code }}</p>
                    <div>
                        <p class="font-semibold">Telepon:</p>
                        <p>{{ $address->phone }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan -->
        <div class="lg:w-1/4 w-full">
            <div class="bg-blue-100 rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Ringkasan</h2>
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                </div>
                <hr class="my-2 border-black">
                <div class="flex justify-between mb-2 font-semibold">
                    <span>Total Keseluruhan</span>
                    <span>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
