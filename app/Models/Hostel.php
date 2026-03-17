<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    //
    protected $fillable = [
        'owner_id',
        'name',
        'location',
        'capacity',
        'manager_name',
        'contact_number',
        'description'
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Room::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');

    }

    public function getOccupiedRoomsCountAttribute()
    {
        // count occupied rooms for this hostel (case-insensitive)
        return $this->rooms()
                    ->whereRaw('LOWER(status) = ?', ['occupied'])
                    ->count();
    }

    public function getRemainingCapacityAttribute()
    {
        $capacity = (int) ($this->capacity ?? 0);
        $occupied = (int) $this->occupied_rooms_count;

        return max(0, $capacity - $occupied);
    }

    public function getRemainingColorAttribute(){

              $remaining_capacity = strtolower($this->attributes['remaining_capacity'] ?? '');

    return match($remaining_capacity) {

            40 => 'red-600 text-white px-2 py-1 rounded',

        };

}


    //     'single'  => 'red-600 text-white px-2 py-1 rounded',
    //     'double'    => 'indigo-600 text-white px-2 py-1 rounded',
    //     'self contained' => 'green-600 text-white px-2 py-1 rounded',
    //     default     => 'gray-400',
    // };
    // }
}
