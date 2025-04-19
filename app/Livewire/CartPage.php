<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart - FrozenFood')]
class CartPage extends Component
{
    public int $shipping_cost = 20000;
    public array $cart_items = [];
    public int $grand_total = 0;

    public function mount()
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->calculateTotal();
    }

    public function removeItem($product_id)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->calculateTotal();

        // Update cart count di navbar
        $this->dispatch('updateCartCount', count($this->cart_items))->to(Navbar::class);
    }

    public function increaseQty($product_id)
    {
        $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        $this->calculateTotal();
    }

    public function decreaseQty($product_id)
    {
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $subtotal = collect($this->cart_items)->sum('total_amount');
        $this->grand_total = $subtotal + $this->shipping_cost;
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
