<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Product;
use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Brand;
use App\Models\Category;

#[Title('Products - FrozenFood')]
class ProductsPage extends Component
{
    use WithPagination;

    // Properti yang digunakan untuk filter
    #[Url] public $selected_categories = [];
    #[Url] public $selected_brands = [];
    #[Url] public $featured = [];
    #[Url] public $on_sale = [];
    #[Url] public $price_range = 300000;
    #[Url] public $sort = 'latest';

    // Menambahkan produk ke keranjang
    public function addToCart($product_id)
    {
        // Menambahkan item ke keranjang dan mendapatkan total count
        $total_count = CartManagement::addItemToCartWithQty($product_id);

        // Mengirimkan event untuk update jumlah item di keranjang
        $this->dispatch('update-cart-count', total_countId: $total_count);

        // Menampilkan alert dengan menggunakan LivewireAlert facade
        LivewireAlert::success(
            'Berhasil!',
            'Produk berhasil ditambahkan ke keranjang',
            [
                'position' => 'bottom-end',  // Menampilkan alert di bagian bawah kanan
                'timer' => 3000,  // Mengatur waktu tampil alert (3000ms)
                'toast' => true,  // Menampilkan toast alert
            ]
        );
    }

    // Menampilkan produk dengan filter yang sesuai
    public function render()
    {
        // Query untuk mengambil produk yang aktif
        $productQuery = Product::query()->where('is_active', 1);

        // Mengaplikasikan filter berdasarkan kategori yang dipilih
        if (count($this->selected_categories) > 0) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        // Mengaplikasikan filter berdasarkan brand yang dipilih
        if (count($this->selected_brands) > 0) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        // Menampilkan produk yang ditandai sebagai featured
        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        // Menampilkan produk yang sedang diskon atau on sale
        if ($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }

        // Menyaring produk berdasarkan rentang harga
        if ($this->price_range > 0) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        // Menyortir produk berdasarkan yang terbaru
        if ($this->sort === 'latest') {
            $productQuery->latest();
        }

        // Menyortir produk berdasarkan harga
        if ($this->sort === 'price') {
            $productQuery->orderBy('price');
        }

        // Menggunakan eager loading untuk mengurangi query tambahan untuk kategori dan brand
        $products = $productQuery->with(['category', 'brand'])->paginate(9);

        // Menampilkan data produk, kategori, dan brand di view
        return view('livewire.products-page', [
            'products' => $products,
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
