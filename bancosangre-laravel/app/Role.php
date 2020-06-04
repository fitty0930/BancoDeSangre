<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id';
    //
    public function users()
    {
        // return $this
        //     ->belongsToMany('App\User')
        //     ->withTimestamps();
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
