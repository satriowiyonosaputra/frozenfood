<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="overflow-hidden bg-blue-50 py-11 font-poppins dark:bg-blue-50" x-data="{
        mainImage: '{{ asset('storage/' . ($product->images[0] ?? '')) }}'
    }">
        <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
            <div class="flex flex-wrap -mx-4">

                {{-- Brand Logo --}}
                @if (isset($brand))
                    <div class="w-full mb-6">
                        <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}"
                            class="border-4 border-white text-black w-60">
                    </div>
                @endif

                {{-- Left Side: Image Gallery --}}
                <div class="sticky top-0 z-10 w-full md:w-1/2 pl-6 pr-2">

                    {{-- Gambar Utama --}}
                    <div class="relative mb-6 lg:mb-10">
                        <img :src="mainImage" alt="{{ $product->name }}"
                            class="object-cover w-full h-96 rounded-md shadow-md">
                    </div>

                    {{-- Thumbnail --}}
                    <div class="flex-wrap hidden md:flex gap-4">
                        @foreach ($product->images as $index => $image)
                            <div class="w-1/4 border-2 border-white p-2 cursor-pointer rounded-md shadow-sm hover:border-blue-500"
                                @click="mainImage='{{ asset('storage/' . $image) }}'">
                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}"
                                    class="object-cover w-full h-20 rounded">
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right Side: Product Info --}}
                <div class="w-full md:w-1/2 px-4 mt-10 md:mt-0">
                    <div class="lg:pl-10">
                        {{-- Product Name --}}
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h2>

                        {{-- Price --}}
                        <p class="text-4xl font-bold text-blue-600 mb-4">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <div class="prose prose-invert text-black mb-6">
                            {!! Str::markdown($product->description ?? '') !!}
                        </div>

                        {{-- Quantity Control --}}
                        <div class="w-32 mb-6">
                            <label class="block text-sm font-medium text-white mb-1">Total</label>
                            <div class="flex items-center rounded-md overflow-hidden border border-gray-300 bg-white">
                                <button wire:click='decreaseQty'
                                    class="w-8 h-8 text-base font-bold text-black hover:bg-gray-200 transition">-</button>
                                <input type="number" wire:model='quantity' readonly value="1"
                                    class="w-10 text-center bg-transparent text-black text-sm outline-none border-l border-r border-gray-300" />
                                <button wire:click='increaseQty'
                                    class="w-8 h-8 text-base font-bold text-black hover:bg-gray-200 transition">+</button>
                            </div>
                        </div>


                        {{-- Add to Cart Button --}}
                        <button wire:click='addToCart({{ $product->id }})'
                            class="w-full md:w-1/2 bg-white border border-blue-600 hover:bg-blue-700 hover:text-white py-3 rounded-lg font-semibold transition">
                            <span wire:loading.remove wire:target='addToCart({{ $product->id }})'>Tambah ke
                                Keranjang</span>
                            <span wire:loading wire:target='addToCart({{ $product->id }})'>Loading...</span>
                        </button>
                        <div
                        <div
                        x-data="{ show: false, message: '' }"
                        x-on:product-added.window="
                            message = $event.detail.message;
                            show = true;
                            setTimeout(() => show = false, 3000);
                        "
                        x-show="show"
                        x-transition
                        class="fixed inset-0 flex items-center justify-center z-50"
                        style="display: none;"
                    >
                        <div class="bg-white border border-gray-300 text-gray-800 px-6 py-4 rounded-xl shadow-lg w-[90%] max-w-sm text-center">
                            <div class="flex justify-center mb-2">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="text-base font-medium" x-text="message"></div>
                        </div>
                    </div>


                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
