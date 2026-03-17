<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $fillable=[
        'hostel_id',
        'room_number',
        'capacity',
        'price',
        'room_type',
        'status',
    ];

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

     public function user()
     {
        return $this->belongsTo(User::class);
     }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

public function getStatusColorAttribute()
{
    $status = strtolower($this->attributes['status'] ?? '');

    return match($status) {
        'occupied'  => 'red-600 text-white px-2 py-1 rounded',
        'vacant'    => 'indigo-600 text-white px-2 py-1 rounded',
        'available' => 'green-600 text-white px-2 py-1 rounded',
        default     => 'gray-400',
    };
}

public function getRoomColorAttribute(){
        $room_type = strtolower($this->attributes['room_type'] ?? '');

    return match($room_type) {
        'single'  => 'red-600 text-white px-2 py-1 rounded',
        'double'    => 'indigo-600 text-white px-2 py-1 rounded',
        'self contained' => 'green-600 text-white px-2 py-1 rounded',
        default     => 'gray-400',
    };
}


}
