<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paid extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paid_ebook';

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
    protected $fillable = ['id','book_id', 'store_name', 'store_logo', 'link', 'price'];

    /**
     * Get the discounts for the paid e-book stores.
     */
    public function discount()
    {
        return $this->hasMany('App\PaidDiscount', 'paid_ebook_id');
    }
}