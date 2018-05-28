<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

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
    protected $fillable = ['plan_id', 'user_id', 'merchantOrderId', 'price', 'currencyCode', 'transactionId', 'orderNumber'];


    /**
     * Get the user record associated with the transaction.
     */
    public function user_record()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * Get the plans for the users.
     */
    public function plan_transaction()
    {
        return $this->belongsTo('App\Plan','plan_id');
    }
}