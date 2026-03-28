<div class="max-w-5xl mx-auto p-6 space-y-6">

    <h2 class="text-xl font-bold">Buy Products</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-3 rounded">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Product</th>
                <th class="p-2">Price</th>
                <th class="p-2">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="border-t">
                    <td class="p-2">{{ $product->name }}</td>
                    <td class="p-2 text-center">₹{{ $product->price }}</td>
                    <td class="p-2 text-center">
                        <input
                            type="number"
                            min="0"
                            class="w-20 border rounded p-1"
                            wire:model.defer="cart.{{ $product->id }}"
                        />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <label class="block font-semibold mb-1">Payment Method</label>
        <select wire:model="payment_method" class="border rounded p-2">
            @foreach (config('payment.methods') as $key => $label)
                <option value="{{ $key }}">{{ $label['label'] }}</option>
            @endforeach
        </select>
    </div>

    <button
        wire:click="placeOrder"
        class="bg-indigo-600 text-white px-6 py-2 rounded"
    >
        Place Order
    </button>

</div>
