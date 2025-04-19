<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="flex items-center font-poppins dark:bg-white-300">
        <div
            class="justify-center flex-1 max-w-6xl px-4 py-4 mx-auto bg-white border rounded-md dark:border-gray-300 dark:bg-white md:py-10 md:px-10">
            <div>
                <h1 class="px-4 mb-8 text-2xl font-semibold tracking-wide text-gray-700 dark:text-black-300">
                    Terima kasih. Pesanan Anda telah diterima.
                </h1>

                {{-- Informasi Pengiriman --}}
                <div
                    class="flex flex-col md:flex-row xl:flex-col w-full h-full px-4 mb-8 border-b border-gray-200 dark:border-gray-700 space-y-4 md:space-y-0 md:space-x-6 lg:space-x-8 xl:space-x-0">
                    <div class="flex items-start w-full">
                        <div class="flex items-start w-full pb-6 space-x-4">
                            <div class="flex flex-col space-y-2 w-full break-words">
                                <div class="bg-white shadow rounded-lg p-6">
                                    <h2 class="text-xl font-semibold mb-4">Alamat Pengiriman</h2>
                                    <p><strong>Nama:</strong> {{ $order->address->full_name }}</p>
                                    <p><strong>Telepon:</strong> {{ $order->address->phone }}</p>
                                    <p><strong>Alamat:</strong> {{ $order->address->street_address }}</p>
                                    <p>{{ $order->address->city }}, {{ $order->address->state }}
                                        {{ $order->address->zip_code }}</p>
                                </div>

                                @if (!empty($order->address->notes))
                                    <p class="text-sm italic leading-4 text-gray-500 dark:text-gray-600 break-words">
                                        Catatan: {{ $order->address->notes }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Info Ringkas --}}
                <div class="flex flex-wrap items-center pb-4 mb-10 border-b border-gray-200 dark:border-gray-700">
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-black">Nomor Pesanan:</p>
                        <p class="text-base font-semibold leading-4 text-gray-800 dark:text-black-400">
                            {{ $order->id }}
                        </p>
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-black-400">Tanggal:</p>
                        <p class="text-base font-semibold leading-4 text-gray-800 dark:text-black-400">
                            {{ $order->created_at->format('d-m-Y') }}
                        </p>
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <p class="mb-2 text-sm font-medium leading-5 text-gray-800 dark:text-black-400">Total:</p>
                        <p class="text-base font-semibold leading-4 text-black-600 dark:text-black-400">
                            Rp{{ number_format($order->total_cost ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-black-400">Ongkir:</p>
                        <p class="text-base font-semibold leading-4 text-black-600 dark:text-black-400">
                            Rp{{ number_format($order->shipping_amount ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-black-400">Metode Pembayaran:</p>
                        <p class="text-base font-semibold leading-4 text-black-800 dark:text-black-400">
                            {{ $order->payment_method == 'cod' ? 'Cash on Delivery' : 'Kartu' }}
                        </p>
                    </div>
                </div>

                {{-- Info Pengiriman --}}
                <div class="px-4 mb-10">
                    <h2 class="mb-4 text-xl font-semibold text-gray-700 dark:text-black-400">Pengiriman</h2>
                    <div class="flex items-start justify-between w-full px-2 md:px-8">
                        <div class="flex items-center space-x-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="w-6 h-6 text-blue-600 dark:text-blue-400" viewBox="0 0 16 16">
                                <path
                                    d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7z" />
                            </svg>
                            <div>
                                @php
                                    $method = $order->shipping_method ?? 'standard';
                                    $methodLabel = match ($method) {
                                        'instant' => 'Pengiriman Instant (2 Jam)',
                                        'same_day' => 'Same Day Delivery',
                                        'next_day' => 'Next Day',
                                        'regular' => 'Pengiriman Reguler',
                                        default => 'Pengiriman Standard',
                                    };
                                @endphp
                                <p class="text-base font-semibold text-black-800 dark:text-black-400">
                                    {{ $methodLabel }}</p>
                                <p class="text-sm text-gray-500">Estimasi sesuai metode</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Navigasi --}}
                <div class="flex items-center justify-start gap-4 px-4 mt-6">
                    <a href="/products"
                        class="w-full text-center px-4 py-2 text-blue-500 border border-blue-500 rounded-md md:w-auto hover:text-white hover:bg-blue-600 dark:border-gray-700 dark:hover:bg-gray-700 dark:text-black-300">
                        Kembali Belanja
                    </a>
                    <a href="/my-orders"
                        class="w-full text-center px-4 py-2 bg-blue-500 rounded-md text-gray-50 md:w-auto dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 dark:bg-gray-800">
                        Lihat Pesanan Saya
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
