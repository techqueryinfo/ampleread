<?php

namespace App\Http\Controllers;
use App\Category;
use App\Country;
use App\Book;
use App\HomeBook;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
    	$countries = Country::all();
        $books = Book::all();
        $categories = Category::all();
        $special_features = HomeBook::with('home_books')->get(); 
        //echo "<pre>"; print_r($special_features); die;
        return view('welcome', compact('countries', 'books', 'categories', 'special_features'));
    }
}
