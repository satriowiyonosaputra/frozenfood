<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="py-10 dark:bg-blue-50 font-poppins dark:bg-white-800 rounded-lg">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="flex flex-wrap mb-24 -mx-3">
                <!-- Sidebar Filters -->
                <div class="w-full pr-2 lg:w-1/4 lg:block">
                    <!-- Kategori Filter -->
                    <div class="p-4 mb-5 dark:bg-white border border-white-200 dark:border-white-900 dark:bg-white-900">
                        <h2 class="text-2xl font-bold dark:text-black">Kategori</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            @foreach ($categories as $category)
                                <li class="mb-4" wire:key="{{ $category->id }}">
                                    <label for="{{ $category->slug }}" class="flex items-center dark:text-black ">
                                        <input type="checkbox" wire:model="selected_categories"
                                            id="{{ $category->slug }}" value="{{ $category->id }}" class="w-4 h-4 mr-2">
                                        <span class="text-lg">{{ $category->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Merek Filter -->
                    <div class="p-4 mb-5 dark:bg-white border border-gray-200 dark:bg-black-900 dark:border-white-900">
                        <h2 class="text-2xl font-bold dark:text-black">Merek</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            @foreach ($brands as $brand)
                                <li class="mb-4" wire:key="{{ $brand->id }}">
                                    <label for="{{ $brand->slug }}" class="flex items-center dark:text-black ">
                                        <input type="checkbox" wire:model="selected_brands" id="{{ $brand->slug }}"
                                            value="{{ $brand->id }}" class="w-4 h-4 mr-2">
                                        <span class="text-lg">{{ $brand->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Status Barang Filter -->
                    <div class="p-4 mb-5 dark:bg-white border border-black-200 bg-white dark:border--white-900">
                        <h2 class="text-2xl font-bold dark:text-black">Status Barang</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            <li class="mb-4">
                                <label for="featured" class="flex items-center dark:text-black">
                                    <input type="checkbox" wire:model="featured" id="featured" value="1"
                                        class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-black">Produk Unggulan</span>
                                </label>
                            </li>
                            <li class="mb-4">
                                <label for="on_sale" class="flex items-center dark:text-black-300">
                                    <input type="checkbox" wire:model="on_sale" id="on_sale" value="1"
                                        class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-black">Di Jual</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <!-- Harga Filter -->
                    <div class="p-4 mb-5 dark:bg-white border border-gray-200 dark:bg-white-900 dark:border-white-900">
                        <h2 class="text-2xl font-bold dark:text-black">Harga</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <div>
                            <div class="semi-bold text-black">Rp {{ number_format($price_range, 0, ',', '.') }} </div>
                            <input type="range" wire:model="price_range"
                                class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer"
                                max="500000" value="300000" step="1000">
                            <div class="flex justify-between">
                                <span class="inline-block text-lg font-bold text-blue-400 ">Rp 1.000</span>
                                <span class="inline-block text-lg font-bold text-blue-400 ">Rp 500.000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produk List -->
                <div class="w-full px-3 lg:w-3/4">
                    <div class="px-3 mb-4">
                        <div class="items-center justify-between hidden px-3 py-2 bg-white-100 md:flex dark:bg-blue-50">
                            <div class="flex items-center justify-between">
                                <select wire:model="sort"
                                    class="block w-40 text-base bg-grey-100 cursor-pointer dark:text-black dark:bg-blue-50">
                                    <option value="latest">Urutan Berdasarkan yang Terbaru</option>
                                    <option value="price">Urutan berdasarkan Harga</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center">
                        @foreach ($products as $product)
                            <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3" wire:key="{{ $product->id }}">
                                <div class="border border-gray-300 dark:border-white-700">
                                    <div class="relative bg-gray-200">
                                        @if (!empty($product->images) && isset($product->images[0]))
                                            <a href="/products/{{ $product->slug }}">
                                                <img src="{{ url('storage/' . $product->images[0]) }}"
                                                    alt="{{ $product->name }}"
                                                    class="object-cover w-full h-56 mx-auto">
                                            </a>
                                        @else
                                            <a href="/products/{{ $product->slug }}">
                                                <img src="{{ url('images/default.jpg') }}" alt="No image"
                                                    class="object-cover w-full h-56 mx-auto">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="p-3">
                                        <div class="flex items-center justify-between gap-2 mb-2">
                                            <h3 class="text-xl font-medium dark:text-black">
                                                {{ $product->name }}
                                            </h3>
                                        </div>
                                        <p class="text-lg">
                                            <span class="text-white-600 dark:text-white-600">
                                                Rp {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                        </p>
                                    </div>
                                    <div
                                        class="flex justify-center p-4 border-t border-black-300 dark:border-black-700">
                                        <a wire:click.prevent='addToCart({{ $product->id }})' href="#"
                                            class="text-black flex items-center space-x-2 dark:text-white-400 hover:text-red-500 dark:hover:text-red-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="w-4 h-4 bi bi-cart3" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                                </path>
                                            </svg><span wire:loading.remove
                                                wire:target='addToCart({{ $product->id }})'> Tambah ke
                                                Keranjang</span><span wire:loading
                                                wire:target='addToCart({{ $product->id }})'>Adding....</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-end mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
