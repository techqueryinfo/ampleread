<?php

namespace App\Http\Controllers;

use App\Category;
use App\Book;
use App\Paid;
use App\PaidDiscount;
use DB;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

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
        $categories = Category::all();
        $requestData = $request->all();
        if ($request->hasFile('ebook_logo')) 
        {
            $uploadPath = public_path('/uploads/ebook_logo');
            $file = $request->file('ebook_logo');
            $file->move($uploadPath, $file->getClientOriginalName());
            $requestData['ebook_logo'] = $file->getClientOriginalName();
        } 
        Book::create($requestData);
        return view('books.ebook', compact('categories'));
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
        $username = $book->user_name()->first()->first_name." ".$book->user_name()->first()->last_name;
        $paid = Paid::where('book_id', '=', $id)->get();
        $paidDiscount = DB::table('paid_discount')
        ->join('paid_ebook', function($join){
            $join->on('paid_discount.book_id', '=', 'paid_ebook.book_id')
            ->on('paid_discount.paid_ebook_id', '=', 'paid_ebook.id');
        })
        ->select('paid_discount.*', 'paid_ebook.store_logo', 'paid_ebook.store_name')
        ->where('paid_discount.book_id', '=', $id)
        ->orWhere('paid_ebook.book_id', '=', $id)
        ->get();
        return view('books.edit', compact('book', 'categories', 'paid', 'paidDiscount', 'phone', 'username'));
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
        return redirect('book')->with('flash_message', 'E-Book updated !');
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
    
    /**
     * Get All books of a particular category
     *
     * @param  string category_name
     *
     * @return \Illuminate\View\View
     */
    public function show_books_by_category($category_name)
    {
        $currentUser = Auth::user();
        $category_slug = str_slug($category_name, '-');
        // print_r($category_name); exit();
       $books = Book::where('category', '=', $category_slug)->with('user_name')->get();
       $category = Category::where('category_slug', '=', $category_slug)->first();
       $data = [
       'books' => $books,
       'category_name' => $category_name,
       'category' => $category
       ];

       // return view('books.show_books_by_category')->with($data);
       if(!empty($currentUser) && $currentUser->isAdmin())
       {
         return view('books.book_category')->with($data);
       }
       else {
       return view('books.show_books_by_category')->with($data);
       }
    }
}