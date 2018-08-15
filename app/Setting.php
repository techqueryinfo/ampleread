<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

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
    protected $fillable = ['site_tite', 'site_meta_keyword', 'site_meta_desc', 'admin_email', 'from_email', 'from_name', 'site_logo', 'payment_api_key', 'payment_api_token'];

    
}
