<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('My Orders')]
class MyOrdersPage extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::where('user_id', auth()->id())  // Mengambil hanya order milik user yang login
            ->latest()  // Mengurutkan berdasarkan tanggal terbaru
            ->paginate(10);  // Menambahkan paginasi dengan 10 order per halaman


        return view('livewire.my-orders-page', [
            'orders' => $orders,
        ]);
    }
    
}
