<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'role_id', 'department_id', 'email', 'password', 'student_number', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
     * Return the collection containing department object associated
     * with the user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
