<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'images',
        'description',
        'price',
        'is_active',
        'is_featured',
        'in_stock',
        'on_sale',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function render()
{
    $products = Product::with('category')->paginate(9);  // Pastikan kategori dimuat bersama produk

    return view('livewire.products-page', [
        'products' => $products,
        'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
        'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
    ]);
}

}
