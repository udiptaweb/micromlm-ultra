<?php

namespace App\Livewire\Member\Wallet;

use App\Models\PayoutInfo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManagePayoutInfo extends Component
{
    // ── Modal state ───────────────────────────────────────────────
    public bool    $showModal    = false;
    public ?int    $editingId    = null;   // null = creating new

    // ── Form fields ───────────────────────────────────────────────
    public string  $method       = 'bank';
    public string  $label        = '';

    // Bank
    public string  $bank_name        = '';
    public string  $account_holder   = '';
    public string  $account_number   = '';
    public string  $ifsc_code        = '';
    public string  $branch           = '';

    // UPI
    public string  $upi_id           = '';

    // Crypto
    public string  $crypto_network   = '';
    public string  $wallet_address   = '';

    // ── Validation rules ─────────────────────────────────────────
    protected function rules(): array
    {
        $base = [
            'method' => 'required|in:bank,upi,crypto',
            'label'  => 'nullable|string|max:80',
        ];

        return match ($this->method) {
            'bank'   => $base + [
                'bank_name'      => 'required|string|max:100',
                'account_holder' => 'required|string|max:100',
                'account_number' => 'required|string|max:30',
                'ifsc_code'      => 'required|string|max:20',
                'branch'         => 'nullable|string|max:100',
            ],
            'upi'    => $base + [
                'upi_id' => 'required|string|max:100',
            ],
            'crypto' => $base + [
                'crypto_network' => 'required|string|max:20',
                'wallet_address' => 'required|string|max:200',
            ],
            default  => $base,
        };
    }

    // ── Open add modal ────────────────────────────────────────────
    public function openAdd(): void
    {
        $this->resetFields();
        $this->editingId = null;
        $this->showModal = true;
    }

    // ── Open edit modal ───────────────────────────────────────────
    public function openEdit(int $id): void
    {
        $info = PayoutInfo::where('user_id', Auth::id())->findOrFail($id);

        $this->editingId       = $info->id;
        $this->method          = $info->method;
        $this->label           = $info->label ?? '';
        $this->bank_name       = $info->bank_name ?? '';
        $this->account_holder  = $info->account_holder ?? '';
        $this->account_number  = $info->account_number ?? '';
        $this->ifsc_code       = $info->ifsc_code ?? '';
        $this->branch          = $info->branch ?? '';
        $this->upi_id          = $info->upi_id ?? '';
        $this->crypto_network  = $info->crypto_network ?? '';
        $this->wallet_address  = $info->wallet_address ?? '';

        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetFields();
    }

    // ── Save (create or update) ───────────────────────────────────
    public function save(): void
    {
        $this->validate();

        $data = [
            'method'         => $this->method,
            'label'          => $this->label ?: null,
            'bank_name'      => $this->method === 'bank'   ? $this->bank_name      : null,
            'account_holder' => $this->method === 'bank'   ? $this->account_holder : null,
            'account_number' => $this->method === 'bank'   ? $this->account_number : null,
            'ifsc_code'      => $this->method === 'bank'   ? $this->ifsc_code      : null,
            'branch'         => $this->method === 'bank'   ? $this->branch         : null,
            'upi_id'         => $this->method === 'upi'    ? $this->upi_id         : null,
            'crypto_network' => $this->method === 'crypto' ? $this->crypto_network : null,
            'wallet_address' => $this->method === 'crypto' ? $this->wallet_address : null,
        ];

        if ($this->editingId) {
            PayoutInfo::where('user_id', Auth::id())
                ->findOrFail($this->editingId)
                ->update($data);
        } else {
            // Auto-set as default if first of this method
            $isFirst = !PayoutInfo::where('user_id', Auth::id())
                ->where('method', $this->method)
                ->exists();

            PayoutInfo::create(array_merge($data, [
                'user_id'    => Auth::id(),
                'is_default' => $isFirst,
            ]));
        }

        $this->closeModal();
        session()->flash('payout_info_saved', 'Payout details saved.');
    }

    // ── Set default ───────────────────────────────────────────────
    public function setDefault(int $id): void
    {
        $info = PayoutInfo::where('user_id', Auth::id())->findOrFail($id);

        // Unset other defaults for same method
        PayoutInfo::where('user_id', Auth::id())
            ->where('method', $info->method)
            ->update(['is_default' => false]);

        $info->update(['is_default' => true]);
    }

    // ── Delete ────────────────────────────────────────────────────
    public function delete(int $id): void
    {
        $info = PayoutInfo::where('user_id', Auth::id())->findOrFail($id);
        $wasDefault = $info->is_default;
        $method     = $info->method;
        $info->delete();

        // If we deleted the default, promote the next one
        if ($wasDefault) {
            PayoutInfo::where('user_id', Auth::id())
                ->where('method', $method)
                ->oldest()
                ->first()
                ?->update(['is_default' => true]);
        }
    }

    private function resetFields(): void
    {
        $this->reset([
            'method', 'label',
            'bank_name', 'account_holder', 'account_number', 'ifsc_code', 'branch',
            'upi_id',
            'crypto_network', 'wallet_address',
        ]);
        $this->method = 'bank';
    }

    public function render()
    {
        $infos = PayoutInfo::where('user_id', Auth::id())
            ->orderBy('method')
            ->orderByDesc('is_default')
            ->get()
            ->groupBy('method');

        return view('livewire.member.wallet.manage-payout-info', [
            'infos' => $infos,
        ])->layout('layouts.app');
    }
}