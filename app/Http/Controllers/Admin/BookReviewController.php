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
    	$created_books = Book::where('status', 0)->get();
        $submitted_books = Book::where('status', 1)->get();
    	return view('admin.bookreview.index',compact('created_books', 'submitted_books'));
    }

    /*
    *   Book Approve
    */

    public function book_approve(Request $request)
    {
        $requestData = $request->all();
        $id = $requestData['book_id'];
        $book = Book::findOrFail($id);
        $book->update($requestData);
        return redirect('admin/review')->with('flash_message', 'E-Book approved successfully !');
    }

    /*
    *   Book Decline
    */

    public function book_decline(Request $request)
    {
        $requestData = $request->all();
        $id = $requestData['book_id'];
        $book = Book::findOrFail($id);
        $book->update($requestData);
        return redirect('admin/review')->with('flash_message', 'E-Book declined successfully !');
    }
}