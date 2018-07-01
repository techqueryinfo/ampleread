<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookContents extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'book_contents';

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
    protected $fillable = ['id', 'book_id', 'chapters'];
}