<?php

namespace App\Http\Controllers;
use App\Category;
use App\Country;
use App\Book;
use App\HomeBook;
use App\Home;
use Auth;

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
        $save_books       = Book::where('status', 0)->get();
        $publish_books    = Book::where('status', 2)->get();
        $banner_images = Home::all();
        $user = Auth::user();
        if ($user->isAdmin()) 
        {
            return view('pages.admin.home');
        }
        return view('pages.user.home', compact('countries', 'save_books', 'publish_books', 'banner_images'));
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
