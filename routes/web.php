<?php

use App\Livewire\HomePage;
use App\Livewire\CategoriesPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\CartPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ForgotPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CheckoutPage;
use App\Livewire\CancelPage;
use App\Livewire\SuccessPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\MyOrdersDetailPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);
Route::get('/categories', CategoriesPage::class);
Route::get('/products', ProductsPage::class);
Route::get('/cart', CartPage::class);
Route::get('/products/{slug}', ProductDetailPage::class);

Route::middleware('guest')->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class);
    Route::get('/forgot', ForgotPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {

    // POST logout
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');

    // Halaman checkout
    Route::get('/checkout', CheckoutPage::class)->name('checkout');

    // Hapus duplikasi dan betulkan nama route
    Route::get('/success', SuccessPage::class)->name('success'); // <-- ini route yang benar
    Route::get('/cancel', CancelPage::class)->name('cancel');

    // My Orders
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
    Route::get('/my-orders/{order_id}', MyOrdersDetailPage::class)->name('my-orders.show');
});
