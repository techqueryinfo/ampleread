<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaidDiscount extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paid_discount';

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
    protected $fillable = ['id', 'paid_ebook_id', 'book_id', 'discount', 'additional_options', 'desc'];
}