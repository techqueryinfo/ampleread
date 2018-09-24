<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookSave extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'book_save';

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
    protected $fillable = ['id', 'book_id', 'user_id'];
}