<?php

namespace App\Livewire\Member\EPin;

use App\Models\EPinRequest as ModelsEPinRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class EPinRequest extends Component
{
    use WithFileUploads;

    public $pin_count = 1;
    public $pin_amount;
    public $payment_proof;
    public $note;

    public function submitRequest()
    {
        $this->validate([
            'pin_count' => 'required|integer|min:1',
            'pin_amount' => 'required|numeric|min:1',
            'payment_proof' => 'required|max:2048', // 2MB Max
        ]);

        $path = $this->payment_proof->store('proofs', 'public');

        ModelsEPinRequest::create([
            'user_id' => Auth::id(),
            'pin_count' => $this->pin_count,
            'pin_amount' => $this->pin_amount,
            'total_amount' => $this->pin_count * $this->pin_amount,
            'payment_proof' => $path,
            'member_note' => $this->note,
        ]);

        session()->flash('success', 'Request sent! Pins will be issued after verification.');
    }
    public function render()
    {
        return view('livewire.member.e-pin.e-pin-request')->layout('layouts.app');
    }
}
