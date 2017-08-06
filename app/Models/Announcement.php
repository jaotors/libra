<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'context', 'announce_date'];
    
}
