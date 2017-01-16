<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'role_id', 'action'];
}
