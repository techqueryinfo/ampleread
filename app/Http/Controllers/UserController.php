<?php

namespace App\Http\Controllers;
use App\Category;
use App\Country;
use App\Book;
use App\HomeBook;
use App\Home;
use App\BookReview;
use App\BookSave;
use Auth;
use DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $save_books       = Book::where('status', 0)->where('author', $user->id)->get();
        $publish_books    = Book::where('status', 2)->where('author', $user->id)->get();
        $banner_images    = Home::all();
        
        $reading_books = DB::table('books')
        ->join('book_save', 'book_save.book_id', '=', 'books.id')
        ->join('users', 'users.id', '=', 'book_save.user_id')
        ->join('categories', 'books.category', '=', 'categories.id')
        ->select('categories.*','books.*', 'users.first_name', 'users.last_name', 'users.name')
        ->where('book_save.user_id', '=', $user->id)
        ->where('categories.is_delete', '=', 0)
        ->where('categories.status', '=', 'Active')
        ->where('books.status', '=', 2)
        ->get();

        $related_book = [];
        // $related_book = DB::table('books')
        // ->join('users', 'users.id', '=', 'books.user_id')
        // ->join('categories', 'books.category', '=', 'categories.id')
        // ->select('categories.*','books.*', 'users.first_name', 'users.last_name', 'users.name')
        // ->where('books.user_id', '=', $user->id)
        // ->where('categories.is_delete', '=', 0)
        // ->where('categories.status', '=', 'Active')
        // ->where('books.status', '=', 2)
        // ->get();
        $featured_book = DB::table('books')
        ->join('users', 'users.id', '=', 'books.user_id')
        ->join('categories', 'books.category', '=', 'categories.id')
        ->select('categories.*','books.*', 'users.first_name', 'users.last_name', 'users.name')
        ->where('categories.is_delete', '=', 0)
        ->where('categories.status', '=', 'Active')
        ->where('books.status', '=', 2)
        ->where('books.is_featured', '=', 1)
        ->get();
        // foreach ($related_book as $k => $v) 
        // {
        //     $book_review_star = BookReview::where('book_id', '=', $v->id)->sum('star');
        //     $v->star = $book_review_star/5;
        // }
        foreach ($featured_book as $k => $v) 
        {
            $book_review_star = BookReview::where('book_id', '=', $v->id)->sum('star');
            $v->star = $book_review_star/5;
        } 
        if ($user->isAdmin()) 
        {
            return view('pages.admin.home');
        }
        return view('pages.user.home', compact('countries', 'save_books', 'publish_books', 'banner_images', 'related_book', 'featured_book', 'reading_books'));
    }
    /**

    * Check if this user belongs to a role
    *
    * @return bool
    */
    public function hasRole($role)
    {
        return $this->role == $role;
    }
}
