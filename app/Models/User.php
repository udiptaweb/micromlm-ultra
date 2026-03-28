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
    protected $guarded = ['id'];
    protected $attributes = [
        'role' => 'user',
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
    public function commissionWallet()
    {
        return $this->hasOne(Wallet::class)->where('type', 'commission');
    }
    public function bonusWallet()
    {
        return $this->hasOne(Wallet::class)->where('type', 'bonus');
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function earnedCommissions()
    {
        return $this->hasMany(Commission::class, 'from_user_id');
    }

    public function binaryVolumes()
    {
        return $this->hasMany(BinaryVolume::class);
    }
    public function binaryVolumeSummaries()
    {
        return $this->hasOne(BinaryVolumeSummary::class);
    }
    public function binaryParent()
    {
        return $this->belongsTo(User::class, 'binary_parent_id');
    }
    public function matrixParent()
    {
        return $this->belongsTo(User::class, 'matrix_parent_id');
    }
    public function binaryChildren()
    {
        return $this->hasMany(User::class, 'binary_parent_id');
    }
    public function matrixChildren()
    {
        return $this->hasMany(User::class, 'matrix_parent_id')->orderBy('matrix_position');
    }
    public function leftChild()
    {
        return $this->hasOne(User::class, 'binary_parent_id')->where('binary_position', 'left');
    }
    public function rightChild()
    {
        return $this->hasOne(User::class, 'binary_parent_id')->where('binary_position', 'right');
    }
    public function walletTransactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function payoutInfos()
    {
        return $this->hasMany(\App\Models\PayoutInfo::class);
    }
}
