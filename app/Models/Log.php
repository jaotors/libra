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

    /**
     * Return the collection containing role object associated
     * with the user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Returns the collection containing category objects
     * associated with the log
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
