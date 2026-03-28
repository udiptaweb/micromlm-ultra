<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayoutRequest extends Model
{
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function payoutInfo()
    {
        return $this->belongsTo(PayoutInfo::class);
    }
 
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
 
    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}
