<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plans';

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
    protected $fillable = ['name', 'desc', 'amount', 'status', 'access_time_period', 'access_period_type', 'no_of_book_download', 'publish_submit_book', 'read_ebook_directly', 'create_books', 'share_books', 'access_discount'];

    
}
