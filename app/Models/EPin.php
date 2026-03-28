<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EPin extends Model
{
    protected $fillable = ['code', 'amount', 'created_by', 'used_by', 'used_at', 'status','assigned_to'];

    /**
     * Generate a unique PIN code
     */
    public static function generateCode()
    {
        do {
            $code = strtoupper(Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4));
        } while (self::where('code', $code)->exists());

        return $code;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // The member who currently owns the pin
    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // The admin who created it
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // The member who actually redeemed it
    public function usedBy()
    {
        return $this->belongsTo(User::class, 'used_by');
    }

    // Cast dates automatically
    protected $casts = [
        'used_at' => 'datetime',
    ];
}
