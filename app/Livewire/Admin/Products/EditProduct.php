<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
     use WithFileUploads;

    public Product $product;

    public string $name = '';
    public $image; // new uploaded image
    public ?string $existingImage = null;
    public string $description = '';
    public float|string $price = '';
    public bool $commission_enabled = true;
    public float|string $commission_percent = 0;
    public bool $is_active = true;

    public function mount(Product $product): void
    {
        $this->product = $product;

        $this->name = $product->name;
        $this->existingImage = $product->image;
        $this->description = $product->description ?? '';
        $this->price = $product->price;
        $this->commission_enabled = $product->commission_enabled;
        $this->commission_percent = $product->commission_percent;
        $this->is_active = $product->is_active;
    }

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

    public function updateProduct(): void
    {
        $this->validate();

        $imagePath = $this->existingImage;

        if ($this->image) {
            // delete old image if exists
            if ($this->existingImage && Storage::disk('public')->exists($this->existingImage)) {
                Storage::disk('public')->delete($this->existingImage);
            }

            $imagePath = $this->image->store('products', 'public');
        }

        $this->product->update([
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

        session()->flash('message', 'Product updated successfully.');
    }
    public function render()
    {
        return view('livewire.admin.products.edit-product')->layout('layouts.app');
    }
}
