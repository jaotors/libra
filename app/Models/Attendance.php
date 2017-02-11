<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'type'];

    /**
     * Returns the collection containing objects
     * associated with the log
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
