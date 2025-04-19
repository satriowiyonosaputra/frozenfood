<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductFilter extends Component
{
    public $price_range = 500000;
    public $selected_categories = [];
    public $selected_brands = [];
    public $featured = false;
    public $on_sale = false;
    public $sort = 'latest';

    // Method untuk menampilkan produk dengan filter
    public function render()
    {
        $products = Product::query();

        // Filter berdasarkan kategori
        if (!empty($this->selected_categories)) {
            $products->whereIn('category_id', $this->selected_categories);
        }

        // Filter berdasarkan merek
        if (!empty($this->selected_brands)) {
            $products->whereIn('brand_id', $this->selected_brands);
        }

        // Filter berdasarkan harga
        if ($this->price_range) {
            $products->where('price', '<=', $this->price_range);
        }

        // Filter produk unggulan dan dijual
        if ($this->featured) {
            $products->where('is_featured', true);
        }

        if ($this->on_sale) {
            $products->where('is_on_sale', true);
        }

        // Urutkan berdasarkan pilihan
        if ($this->sort == 'price') {
            $products->orderBy('price');
        } else {
            $products->latest();
        }

        return view('livewire.product-filter', [
            'products' => $products->paginate(9),
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }

    // Method untuk menambahkan produk ke keranjang (misalnya)
    public function addToCart($productId)
    {
        // Logika untuk menambah produk ke keranjang
    }
}
