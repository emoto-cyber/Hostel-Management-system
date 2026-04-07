<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Role extends Model
{
    //
    protected $fillable = [

    'name',
    'guard_name'

    ];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}
