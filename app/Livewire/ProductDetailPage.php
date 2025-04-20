<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Product;
use Livewire\Component;

class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;

    // Fungsi untuk inisialisasi slug
    public function mount($slug)
    {
        $this->slug = $slug;
    }

    // Fungsi untuk menambah kuantitas
    public function increaseQty()
    {
        $this->quantity++; // Menambah kuantitas
    }

    // Fungsi untuk mengurangi kuantitas
    public function decreaseQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--; // Mengurangi kuantitas, tidak boleh kurang dari 1
        }
    }

    // Fungsi untuk menambahkan produk ke keranjang
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        // Ganti ini sesuai cara kamu mengelola cart
        CartManagement::add($product, $this->quantity);

        session()->flash('success', 'Produk ditambahkan ke keranjang!');
    }

    // Render tampilan halaman produk
    public function render()
    {
        $product = Product::where('slug', $this->slug)->firstOrFail();
        return view('livewire.product-detail-page', compact('product'));
    }
}
