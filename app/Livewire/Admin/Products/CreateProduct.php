<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;

    public string $name = '';
    public $image;
    public string $description = '';
    public float|string $price = '';
    public bool $commission_enabled = true;
    public float|string $commission_percent = 0;
    public bool $is_active = true;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'commission_enabled' => ['boolean'],
            'commission_percent' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
                function ($attr, $value, $fail) {
                    if ($this->commission_enabled && $value <= 0) {
                        $fail('Commission percent must be greater than 0.');
                    }
                }
            ],
            'is_active' => ['boolean'],
        ];
    }

    public function createProduct(): void
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        Product::create([
            'name' => $this->name,
            'image' => $imagePath,
            'description' => $this->description,
            'price' => $this->price,
            'commission_enabled' => $this->commission_enabled,
            'commission_percent' => $this->commission_enabled
                ? $this->commission_percent
                : 0,
            'is_active' => $this->is_active,
        ]);

        session()->flash('message', 'Product created successfully.');

        $this->reset([
            'name',
            'image',
            'description',
            'price',
            'commission_enabled',
            'commission_percent',
            'is_active',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.products.create-product')->layout('layouts.app');
    }
}
