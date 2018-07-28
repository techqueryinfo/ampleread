<?php

namespace App\Http\Controllers;
use App\Category;
use App\Country;
use App\Book;
use App\HomeBook;
use App\Home;

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
        $special_features = HomeBook::with('home_books')->where('type', 'special_feature')->get();
        $banner_images = Home::all();
        $new_releases = HomeBook::with('home_books')->where('type', 'new_releases')->get();
        $bestsellers  = HomeBook::with('home_books')->where('type', 'bestsellers')->get();
        $classics     = HomeBook::with('home_books')->where('type', 'classics')->get(); 
        return view('welcome', compact('countries', 'books', 'categories', 'special_features', 'new_releases', 'bestsellers', 'classics', 'banner_images'));
    }

    /*Temporary Controller till construction*/
    public function site()
    {
        return view('index');
    }
}
