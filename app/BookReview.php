<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookReview extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'book_reviews';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'book_id', 'user_id', 'star', 'review_content'];
}