<?php

namespace App\Http\Controllers;

use App\Category;
use App\Book;
use App\Paid;
use App\PaidDiscount;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
    	$keyword = $request->get('search');
        $perPage = 25;
        $categories = Category::all();
        if (!empty($keyword)) 
        {
            $books = Book::where('ebooktitle', 'LIKE', "%$keyword%")
                ->orWhere('subtitle', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } 
        else 
        {
            $books = Book::latest()->paginate($perPage);
        }
       	return view('books.index', compact('books', 'categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
    	$categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        if ($request->hasFile('ebook_logo')) 
        {
            $uploadPath = public_path('/uploads/ebook_logo');
            $file = $request->file('ebook_logo');
            $file->move($uploadPath, $file->getClientOriginalName());
            $requestData['ebook_logo'] = $file->getClientOriginalName();
        } 
        Book::create($requestData);
        return view('books.ebook');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
		return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = Category::all();
        $book = Book::findOrFail($id);
        $paid = Paid::where('book_id', '=', $id)->get();
        $paidDiscount = PaidDiscount::where('book_id', '=', $id)->get();
		return view('books.edit', compact('book', 'categories', 'paid', 'paidDiscount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        if ($request->hasFile('ebook_logo')) 
        {
            $uploadPath = public_path('/uploads/ebook_logo');
            $file = $request->file('ebook_logo');
            $file->move($uploadPath, $file->getClientOriginalName());
            $requestData['ebook_logo'] = $file->getClientOriginalName();
        } 
        $book = Book::findOrFail($id);
        $book->update($requestData);
        return redirect('book')->with('flash_message', 'E-Book updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Book::destroy($id);
        return redirect('book')->with('flash_message', 'E-Book deleted!');
    }
}