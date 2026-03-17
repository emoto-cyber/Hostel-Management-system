<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Payment extends Model
{
    //
    protected $fillable = [
        'user_id',
        'room_id',
        'amount',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function getMonthlyStatusAttribute()
    {
        $startMonth = Carbon::now()->startOfMonth();
        $user = Auth::user();

        // Check if payment is due and unpaid by end of month
        if ($this->user_id === $user->id &&
            $this->status === 'paid' &&
            $this->created_at->month === $startMonth->month) {
            return 'Not Paid';
        }

        return $this->status;
    }

    // public function wallet(){
    //     return $this->belongsTo(Wallet::class);
    // }

    public function scopeSearch($query, $search)
    {
        $term = "%$search%";
       return $query->whereHas('user', function ($q) use ($term) {
            $q->where('name', 'like', $term)
              ->orWhere('adm_no', 'like', $term);
        })->orWhereHas('room.hostel', function ($q) use ($term) {
            $q->where('name', 'like', $term)
              ->orWhere('location', 'like', $term);
        });
    }

    public function scopeMonthly($query, $month)
    {
        if ($month) {
            $monthNum = Carbon::parse($month)->month;
            return $query->whereMonth('created_at', $monthNum);
        }
        return $query;
    }
}
