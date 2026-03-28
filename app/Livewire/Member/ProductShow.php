<?php

namespace App\Livewire\Member;

use App\Models\Product;
use Livewire\Component;

class ProductShow extends Component
{
    public Product $product;

    public function mount($id)
    {
        // Ensure only active products are viewable by members
        $this->product = Product::where('is_active', true)->findOrFail($id);
    }

    public function addToCart()
    {
        // Logic for your cart system
        session()->flash('message', 'Product added to cart successfully!');
    }

    public function render()
    {
        return view('livewire.member.product-show')->layout('layouts.app');
    }
}
