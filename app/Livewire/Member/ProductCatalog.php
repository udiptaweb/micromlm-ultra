<?php

namespace App\Livewire\Member;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCatalog extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.member.product-catalog', [
            'products' => Product::where('is_active', true)
                ->where('name', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(12)
        ])->layout('layouts.app');
    }
}
