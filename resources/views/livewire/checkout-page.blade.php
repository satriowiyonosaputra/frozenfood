<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-bold text-blue-300 dark:text-black mb-4">
        Checkout
    </h1>
    <form wire:submit.prevent='placeOrder' class="grid grid-cols-12 gap-4">
        <div class="md:col-span-12 lg:col-span-8 col-span-12">
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-blue-100">
                <div class="mb-6">
                    <h2 class="text-xl font-bold underline text-white-700 dark:text-black mb-2">
                        Alamat Pengiriman
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 dark:text-black mb-1" for="first_name">Nama Depan</label>
                            <input wire:model='first_name'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-white-700 dark:text-black dark:border-none @error('first_name') border-red-500 @enderror"
                                id="first_name" type="text">
                            @error('first_name')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-black mb-1" for="last_name">Nama
                                Belakang</label>
                            <input wire:model='last_name'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-white-700 dark:text-black dark:border-none @error('last_name') border-red-500 @enderror"
                                id="last_name" type="text">
                            @error('last_name')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700 dark:text-black mb-1" for="phone">Nomor Telepon</label>
                        <input wire:model='phone'
                            class="w-full rounded-lg border py-2 px-3 dark:bg-white-700 dark:text-black dark:border-none @error('phone') border-red-500 @enderror"
                            id="phone" type="text">
                        @error('phone')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700 dark:text-black mb-1" for="address">Alamat Jalan</label>
                        <input wire:model='street_address'
                            class="w-full rounded-lg border py-2 px-3 dark:bg-white-700 dark:text-black dark:border-none @error('street_address') border-red-500 @enderror"
                            id="address" type="text">
                        @error('street_address')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700 dark:text-black mb-1" for="city">Kota</label>
                        <input wire:model='city'
                            class="w-full rounded-lg border py-2 px-3 dark:bg-white-700 dark:text-black dark:border-none @error('city') border-red-500 @enderror"
                            id="city" type="text">
                        @error('city')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-gray-700 dark:text-black mb-1" for="state">Provinsi</label>
                            <input wire:model='state'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-white-700 dark:text-black dark:border-none @error('state') border-red-500 @enderror"
                                id="state" type="text">
                            @error('state')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-black mb-1" for="zip">Kode Pos</label>
                            <input wire:model='zip_code'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-white-700 dark:text-black dark:border-none @error('zip_code') border-red-500 @enderror"
                                id="zip" type="text">
                            @error('zip_code')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-lg font-semibold mb-4 text-black">
                    Pilih Metode Pembayaran
                </div>
                <ul class="grid w-full gap-6 md:grid-cols-2">
                    <li>
                        <input wire:model='payment_method' class="hidden peer" id="payment-cod" required type="radio"
                            value="cod" />
                        <label
                            class="inline-flex items-center justify-between w-full p-5 text-black bg-white border border-white-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:bg-gray-100 dark:text-gray-800 dark:bg-white dark:hover:bg-gray-200"
                            for="payment-cod">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Bayar di Tempat (COD)</div>
                            </div>
                            <svg class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewBox="0 0 14 10"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" />
                            </svg>
                        </label>
                    </li>
                </ul>
                @error('payment_method')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="md:col-span-12 lg:col-span-4 col-span-12">
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-blue-100">
                <div class="text-xl font-bold underline text-gray-700 dark:text-black mb-2">
                    RINGKASAN PESANAN
                </div>
                <div class="flex justify-between mb-2 font-bold text-black">
                    <span>Subtotal</span>
                    <span>Rp{{ number_format($grand_total - $shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between mb-2 font-bold text-black">
                    <span>Pajak</span>
                    <span>Rp0</span>
                </div>
                <div class="flex justify-between mb-2 font-bold text-black">
                    <span>Ongkos Kirim</span>
                    <span>Rp{{ number_format($shipping_cost, 0, ',', '.') }}</span>
                </div>
                <hr class="my-4 h-1 rounded bg-gray-200">
                <div class="flex justify-between mb-2 font-bold text-black">
                    <span>Total Keseluruhan</span>
                    <span>Rp{{ number_format($grand_total, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Tombol Order -->
            <button type="submit"
                class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                <span wire:loading.remove>Pesan Sekarang</span>
                <span wire:loading>Memproses...</span>
            </button>

            <!-- Ringkasan Keranjang -->
            <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-blue-100">
                <div class="text-xl font-bold underline text-gray-700 dark:text-black mb-2">
                    RINGKASAN KERANJANG
                </div>
                <ul class="divide-y divide-gray-200" role="list">
                    @foreach ($cart_items as $ci)
                        <li class="py-3 sm:py-4" wire:key='{{ $ci['product_id'] }}'>
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img
                                    class="w-12 h-12 rounded-full object-cover"
                                    src="{{ url('storage/' . $ci['image']) }}"
                                        alt="{{ $ci['name'] }}"/>
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-black truncate">
                                        {{ $ci['name'] }}
                                    </p>
                                    <p class="text-sm text-gray-600 truncate">
                                        Jumlah: {{ $ci['quantity'] }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-black">
                                    Rp{{ number_format($ci['total_amount'], 0, ',', '.') }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </form>
</div>
