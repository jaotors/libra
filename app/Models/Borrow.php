<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Category;

class Borrow extends Model
{
/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'book_user';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['book_id', 'user_id', 'return_date'];

    /**
     * Returns the collection containing category objects
     * associated with the book_user
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
