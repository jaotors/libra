<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'amount', 'or_number', 'return_history_id', 'payment_date'];

    /**
     * Returns the collection containing objects
     * associated with the log
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
