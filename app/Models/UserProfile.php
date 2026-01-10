<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'id_type',
        'id_number',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
