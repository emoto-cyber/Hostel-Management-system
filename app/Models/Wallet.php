<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //
    protected $fillable=[
        'owner_id',
        'balance'
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }
    
     public function walletTransactions(){
    return $this->hasMany(WalletTransaction::class);
    }
}
