<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Category;

class Reservation extends Model
{

    /**
     * Attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['book_id', 'user_id'];

    /**
     * Returns the collection containing category objects associated with the book_user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Returns the collection containing category objects associated with the book_user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
