<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;

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
    protected $fillable = ['name', 'summary', 'year', 'isbn', 'author', 'category_id', 'status'];

    /**
     * Returns the collection containing category objects
     * associated with the book
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
