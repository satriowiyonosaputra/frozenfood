<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Detail - Westside')]
class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;

    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);
        $this->dispatch('update-cart-count', total_countId: $total_count);
        $this->dispatch('product-added', message: 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
