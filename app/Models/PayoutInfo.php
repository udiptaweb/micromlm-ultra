<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayoutInfo extends Model
{
    protected $fillable = [
        'user_id',
        'method',
        'label',
        'is_default',
        // bank
        'bank_name',
        'account_holder',
        'account_number',
        'ifsc_code',
        'branch',
        // upi
        'upi_id',
        // crypto
        'crypto_network',
        'wallet_address',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    // ── Relationships ─────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ── Helpers ───────────────────────────────────────────────────

    /**
     * Human-readable summary line shown in dropdowns / tables.
     */
    public function getSummaryAttribute(): string
    {
        return match ($this->method) {
            'bank'   => "{$this->bank_name} — {$this->masked_account}",
            'upi'    => $this->upi_id ?? '—',
            'crypto' => "{$this->crypto_network} — {$this->masked_wallet}",
            default  => '—',
        };
    }

    public function getMaskedAccountAttribute(): string
    {
        if (!$this->account_number) return '—';
        return '••••' . substr($this->account_number, -4);
    }

    public function getMaskedWalletAttribute(): string
    {
        if (!$this->wallet_address) return '—';
        return substr($this->wallet_address, 0, 6) . '…' . substr($this->wallet_address, -4);
    }

    /**
     * Display label — falls back to summary if no custom label set.
     */
    public function getDisplayLabelAttribute(): string
    {
        return $this->label ?: $this->summary;
    }

    // ── Scopes ────────────────────────────────────────────────────

    public function scopeForMethod($query, string $method)
    {
        return $query->where('method', $method);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
}