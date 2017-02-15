<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\ReturnHistory;

class Book extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'summary', 'year', 'isbn', 'author', 'category_id', 'status', 'call_number', 'publisher', 'material', 'location', 'remarks'];

    /**
     * Returns the collection containing category objects
     * associated with the book
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Returns the collection containing user object
     * associated with the book borrowed
     */
    public function borrower()
    {
        return $this->belongsToMany(User::class, 'book_user')->withPivot('return_date', 'created_at')->withTimestamps();
    }

    /**
     * Returns the collection containing user object
     * associated with the book borrowed
     */
    public function reservation()
    {
        return $this->belongsToMany(User::class, 'reservations');
    }
}
