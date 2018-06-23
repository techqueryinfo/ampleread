<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeBook extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_special_features';

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
    protected $fillable = ['id', 'book_id', 'type', 'created_at', 'updated_at'];

    /**
     * Get the books to show in home page
     */
    public function home_books()
    {
        return $this->belongsTo('App\Book','book_id');
    }
}