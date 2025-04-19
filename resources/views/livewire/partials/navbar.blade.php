<header
    class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white/70 backdrop-blur-md text-sm py-3 md:py-0 shadow-md">
    <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
        <div class="relative md:flex md:items-center md:justify-between">
            <div class="flex items-center justify-between">

                <a class="flex-none text-xl font-semibold text-gray-800" href="/" aria-label="Brand">FrozenFood</a>
                <div class="md:hidden">
                    <button type="button"
                        class="hs-collapse-toggle flex justify-center items-center w-9 h-9 rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100"
                        data-hs-collapse="#navbar-collapse-with-animation"
                        aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <!-- Burger Icon -->
                        <svg class="hs-collapse-open:hidden w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Close Icon -->
                        <svg class="hs-collapse-open:block hidden w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="navbar-collapse-with-animation" class="hs-collapse hidden transition-all duration-300 md:block">
                <div class="flex flex-col md:flex-row md:items-center md:justify-end md:gap-x-7 mt-5 md:mt-0">

                    <a href="/"
                        class="font-medium py-3 md:py-6 text-2xl transition-colors duration-200 {{ Request::is('/') ? 'text-blue-600' : 'text-black hover:text-gray-600' }}">
                        Beranda
                    </a>

                    <a href="/categories"
                        class="font-medium py-3 md:py-6 text-2xl transition-colors duration-200 {{ Request::is('categories*') ? 'text-blue-600' : 'text-black hover:text-gray-600' }}">
                        Kategori
                    </a>

                    <a href="/products"
                        class="font-medium py-3 md:py-6 text-2xl transition-colors duration-200 {{ Request::is('products*') ? 'text-blue-600' : 'text-black hover:text-gray-600' }}">
                        Produk
                    </a>

                    <a href="/cart"
                        class="font-medium flex items-center py-3 md:py-6 text-2xl transition-colors duration-200 {{ Request::is('cart') ? 'text-blue-600' : 'text-black hover:text-gray-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.3 5.5a1 1 0 0 0 .98 1.5h12.7a1 1 0 0 0 .98-1.5L17 13M9 21h.01M15 21h.01" />
                        </svg>
                        Keranjang
                        <span
                            class="ml-2 py-0.5 px-1.5 rounded-full text-xs font-medium bg-blue-50 border border-blue-200 text-blue-600">
                            {{ $total_count }}
                        </span>
                    </a>

                    @auth
                        <div class="relative hs-dropdown [--trigger:click] text-2xl">
                            <button type="button"
                                class="flex items-center gap-x-1 text-gray-700 hover:text-gray-900 font-medium">
                                {{ Auth::user()->name }}
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 9l6 6 6-6" />
                                </svg>
                            </button>
                            <div
                                class="hs-dropdown-menu hidden mt-2 w-44 bg-white shadow-md rounded-lg p-2 border border-gray-100 z-50">
                                <a href="/my-orders"
                                    class="block px-3 py-2 text-sm rounded-md text-gray-800 hover:bg-gray-100">
                                    Pesanan Saya
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-3 py-2 text-sm rounded-md text-gray-800 hover:bg-gray-100">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="pt-3 md:pt-0">
                            <a href="/login"
                                class="py-2.5 px-4 inline-flex items-center text-sm font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 active:bg-blue-800">
                                Masuk
                            </a>
                        </div>
                    @endauth

                </div>
            </div>

        </div>
    </nav>
</header>

<!-- Preline JS -->
<script src="https://unpkg.com/preline@latest/dist/preline.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.HSStaticMethods && window.HSStaticMethods.autoInit();
    });
</script>
