<?php

namespace App\Http\Controllers\Admin;
use App\Book;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
    	$books = Book::where('approve', 0)->get(); //echo "<pre>"; print_r($books); die();
    	return view('admin.bookreview.index',compact('books'));
    }
}