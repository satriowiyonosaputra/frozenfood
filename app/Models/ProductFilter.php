<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Helpers\CartManagement;

class ProductList extends Component
{
    public $products;

    public function mount()
    {
        $this->products = Product::where('is_active', true)->get();
    }

    public function addToCart($productId)
    {
        CartManagement::add($productId);

        $this->dispatch('notify', message: 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function render()
    {
        return view('livewire.product-list', [
            'products' => $this->products
        ]);
    }
}
