<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\User;

class ReturnModel extends Model //cannot use return because it is a keyword
{
    /**
     * Sets the table name
     *
     * @var string
     */
    protected $table = "returns";

    /**
     * Returns the collection containing books associated with the returns
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_return', 'book_id', 'return_id');
    }

    /**
     * Returns the collection containing user associated with the returns
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
