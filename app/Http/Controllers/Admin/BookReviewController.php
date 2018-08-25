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
    	$books = Book::where('status', 0)->get();
    	return view('admin.bookreview.index',compact('books'));
    }

    /*
    *   Book Approve
    */

    public function book_approve(Request $request)
    {
        echo "<pre>"; print_r($request->all()); echo "</pre>"; die();
    }
}