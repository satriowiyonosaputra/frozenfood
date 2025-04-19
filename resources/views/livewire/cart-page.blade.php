<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-6 text-black">Keranjang Belanja</h1>

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Cart Items -->
            <div class="md:w-3/4 w-full">
                <div class="overflow-x-auto bg-blue-100 rounded-lg shadow-md p-6 mb-4">
                    <table class="min-w-[700px] w-full text-sm text-left text-gray-700">
                        <thead>
                            <tr class="border-b text-gray-600">
                                <th class="pb-3">Produk</th>
                                <th class="pb-3 text-center">Harga</th>
                                <th class="pb-3 text-center">Jumlah</th>
                                <th class="pb-3 text-center">Total</th>
                                <th class="pb-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cart_items as $item)
                                <tr wire:key="{{ $item['product_id'] }}" class="border-b last:border-0">
                                    <!-- Produk -->
                                    <td class="py-4">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ url('storage', $item['image']) }}"
                                                class="w-16 h-16 rounded object-cover border" alt="{{ $item['name'] }}">
                                            <span class="font-medium text-gray-800">{{ $item['name'] }}</span>
                                        </div>
                                    </td>

                                    <!-- Harga -->
                                    <td class="py-4 text-center">
                                        Rp {{ number_format($item['unit_amount'], 0, ',', '.') }}
                                    </td>

                                    <!-- Jumlah -->
                                    <td class="py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button wire:click="decreaseQty({{ $item['product_id'] }})"
                                                class="w-8 h-8 flex items-center justify-center border rounded hover:bg-gray-100">
                                                <span class="text-lg font-bold">−</span>
                                            </button>
                                            <span class="w-6 text-center font-medium">{{ $item['quantity'] }}</span>
                                            <button wire:click="increaseQty({{ $item['product_id'] }})"
                                                class="w-8 h-8 flex items-center justify-center border rounded hover:bg-gray-100">
                                                <span class="text-lg font-bold">+</span>
                                            </button>
                                        </div>
                                    </td>

                                    <!-- Total -->
                                    <td class="py-4 text-center">
                                        Rp {{ number_format($item['total_amount'], 0, ',', '.') }}
                                    </td>

                                    <!-- Hapus -->
                                    <td class="py-4 text-center">
                                        <button wire:click="removeItem({{ $item['product_id'] }})"
                                            class="px-4 py-2 rounded-md bg-slate-300 border border-slate-400 hover:bg-red-500 hover:text-white hover:border-red-600 transition-all">
                                            <span wire:loading.remove wire:target="removeItem({{ $item['product_id'] }})">Hapus</span>
                                            <span wire:loading wire:target="removeItem({{ $item['product_id'] }})">...</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-lg font-semibold text-slate-500">
                                        Tidak ada item di keranjang!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Summary -->
            <div class="md:w-1/4 w-full">
                <div class="bg-blue-100 rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4 text-black">Ringkasan</h2>
                    <div class="flex justify-between mb-2 text-gray-700">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format(collect($cart_items)->sum('total_amount'), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-2 text-gray-700">
                        <span>Pajak</span>
                        <span>Rp 0</span>
                    </div>
                    <div class="flex justify-between mb-2 text-gray-700">
                        <span>Ongkir</span>
                        <span>Rp {{ number_format($shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <hr class="my-2 border-black">
                    <div class="flex justify-between mb-4 text-black font-semibold">
                        <span>Total Keseluruhan</span>
                        <span>Rp {{ number_format($grand_total, 0, ',', '.') }}</span>
                    </div>

                    @if ($cart_items && count($cart_items) > 0)
                        <a href="/checkout"
                            class="block bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded-lg transition-all">
                            Checkout
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
