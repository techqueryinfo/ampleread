<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_banner_settings';

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
    protected $fillable = ['id', 'image_name', 'type', 'created_at', 'updated_at'];

}