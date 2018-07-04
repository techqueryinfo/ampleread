<?php

namespace App\Http\Controllers;

use App\Category;
use App\Book;
use App\Paid;
use App\BookContents;
use App\BookNotes;
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
        $book = Book::create($requestData); 
        $category = Category::findOrFail($book->category)->where('id', $book->category)->first();
        //echo $book->id; echo "<pre>"; print_r($book); print_r($category); echo "</pre>";  die;
        return view('books.ebook', compact('categories', 'book', 'category'));
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
       if($category_name == 'all-books')
       {
            $records = DB::table('books')
            ->join('users', 'users.id', '=', 'books.user_id')
            ->join('categories', 'books.category', '=', 'categories.id')
            ->select('categories.*','books.*', 'users.first_name', 'users.last_name', 'users.name')
            ->where('categories.is_delete', '=', 0)
            ->where('categories.status', '=', 'Active')
            ->get(); 
       }
       else
       {
            $records = DB::table('books')
            ->join('users', 'users.id', '=', 'books.user_id')
            ->join('categories', 'books.category', '=', 'categories.id')
            ->select('categories.*', 'books.*', 'users.first_name', 'users.last_name', 'users.name')
            ->where('categories.is_delete', '=', 0)
            ->where('categories.category_slug', '=', $category_name)
            ->where('categories.status', '=', 'Active')
            ->get();
       }
       $categories = Category::all();
       $category = Category::where('category_slug', '=', $category_name)->first();
       $data = [ 'category_name' => $category_name, 'category' => $category, 'categories' => $categories, 'records' => $records ];
       if(!empty($currentUser) && $currentUser->isAdmin())
       {
        return view('books.book_category')->with($data);
       }
       else 
       {
        return view('books.show_books_by_category')->with($data);
       }
    }

    /**
     * Update the specified category in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteCategory(Request $request, $id)
    {
        $requestData = $request->all();
        $category = Category::findOrFail($id);
        $requestData['is_delete'] = 1;
        $category->update($requestData);
        return redirect('/admin/books/category/all-books')->with('flash_message', 'E-Book category deleted!');
    }

    /**
     * View Free E-Book 
    */
    public function view_free_ebook($id)
    {
        $book = Book::findOrFail($id)->where('id', $id);
        $book = $book->first();
        $related_book = DB::table('books')
        ->join('users', 'users.id', '=', 'books.user_id')
        ->join('categories', 'books.category', '=', 'categories.id')
        ->select('categories.*','books.*', 'users.first_name', 'users.last_name', 'users.name')
        ->where('books.type', '=', 'free')
        ->where('categories.is_delete', '=', 0)
        ->where('categories.status', '=', 'Active')
        ->get();
        return view('books.free_ebook', compact('book', 'related_book'));
    }

    /**
     * Save Book Chapters & Notes
    */
    public function saveContent(Request $request)
    {   
        $requestData = $request->all(); 
        echo "<pre>"; print_r($requestData); echo "</pre>"; die;
        return $requestData;
        if(isset($requestData['bookContentID']))
        {
            $requestData['id'] = $requestData['bookContentID'];
            $bookContent = BookContents::findOrFail($requestData['bookContentID']);
            $bookContent->update($requestData);
        }
        else
        {
            $bookContent = BookContents::create($requestData);
        }
        $categories  = Category::all();
        $requestData['id'] = $requestData['book_id'];
        $book = Book::findOrFail($requestData['id']);
        $book->update($requestData);
        $category = Category::findOrFail($book->category)->where('id', $book->category)->first();
        if(isset($requestData['notes']))
        {
            foreach ($requestData['notes'] as $row)
            {
                $notes[] = [ 
                    'book_id'    => $request->input('book_id'), 
                    'note'       => $row, 
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s') 
                ];
            }
            BookNotes::insert($notes);
            $bookNotes = BookNotes::where('book_id', $request->input('book_id'))->get();
        }
        return view('books.ebook', compact('categories', 'book', 'category', 'bookContent', 'bookNotes'));
    }

    public function getBookDetail($id)
    {
        $book = Book::findOrFail($id)->where('id', $id);
        $book = $book->first();
        return $book;
    }
}