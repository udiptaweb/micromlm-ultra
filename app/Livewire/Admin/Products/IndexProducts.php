<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class IndexProducts extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public string $search = '';
    public string $status = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function toggleStatus(Product $product): void
    {
        $product->update([
            'is_active' => ! $product->is_active
        ]);
    }

    public function delete(Product $product): void
    {
        $product->delete();

        session()->flash('message', 'Product deleted successfully.');
    }

    public function render()
    {
        $products = Product::query()
            ->when(
                $this->search,
                fn($q) =>
                $q->where('name', 'like', '%' . $this->search . '%')
            )
            ->when(
                $this->status !== 'all',
                fn($q) =>
                $q->where('is_active', $this->status === 'active')
            )
            ->latest()
            ->paginate(10);
        return view('livewire.admin.products.index-products', [
            'products' => $products
        ])->layout('layouts.app');
    }
}
