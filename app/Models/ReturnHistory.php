<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\User;

class ReturnHistory extends Model
{
    /**
     * Sets the table name
     *
     * @var string
     */
    protected $table = "return_history";

    /**
     * Returns the collection containing books associated with the returns
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_return', 'return_id', 'book_id')->withPivot('penalty');
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
