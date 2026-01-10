<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'level',
        'minimum_sales',
        'minimum_team_sales',
        'minimum_directs',
        'bonus_amount',
        'description',
        'badge_icon',
        'badge_color',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'minimum_sales' => 'decimal:2',
            'minimum_team_sales' => 'decimal:2',
            'bonus_amount' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
