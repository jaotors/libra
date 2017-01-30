<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Return the collection containing user object associated
     *
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
