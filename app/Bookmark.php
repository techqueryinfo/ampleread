<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookmarks';

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
    protected $fillable = ['id', 'user_id', 'book_id', 'chapter_index'];

    /**
     * Get the book record associated with the bookmarks.
     */
    public function book_record()
    {
        return $this->belongsTo('App\Models\Book','book_id');
    }
}