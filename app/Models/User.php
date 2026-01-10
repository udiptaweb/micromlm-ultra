<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'referral_code',
        'sponsor_id',
        'rank_id',
        'position',
        'phone',
        'date_of_birth',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
        ];
    }

    // MLM Relationships
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function sponsor()
    {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    public function downlines()
    {
        return $this->hasMany(User::class, 'sponsor_id');
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function mainWallet()
    {
        return $this->hasOne(Wallet::class)->where('type', 'main');
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function earnedCommissions()
    {
        return $this->hasMany(Commission::class, 'from_user_id');
    }
}
