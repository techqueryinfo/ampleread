<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

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
    protected $fillable = ['id', 'user_id', 'ebooktitle', 'subtitle', 'type', 'category', 'desc', 'ebook_logo'];

    /**
     * Get the user record associated with the book.
     */
    public function userName()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}