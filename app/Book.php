<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

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
    protected $fillable = ['id', 'user_id', 'ebooktitle', 'subtitle', 'author', 'publisher', 'type', 'desc', 'ebook_logo', 'retailPrice', 'buyLink', 'pageCount', 'category', 'status', 'is_featured', 'book_ext'];

    /**
     * Get the user record associated with the book.
     */
    public function user_name()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    /**
     * Get the books to show in home page
     */
    public function paid()
    {
        return $this->hasMany('App\Paid','book_id', 'id');
    }

    /**
     * Get the book content record associated with the book.
     */
    public function book_content()
    {
        return $this->hasOne('App\BookContents');
    }
}