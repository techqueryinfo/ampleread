<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Category;
use App\Book;
use App\Paid;
use App\BookContents;
use App\BookNotes;
use App\BookImages;
use App\PaidDiscount;
use App\BookReview;
use App\Bookmark;
use App\HomeBook;
use DB;

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

    public function search(Request $request, $search_text)
    {

        $keyword = $search_text;
        $perPage = 25;
        $categories = Category::all();
        $author_arr = User::where('name', 'LIKE', "%$keyword%")->pluck('id');

        if (!empty($keyword)) 
        {
            $books = Book::where('ebooktitle', 'LIKE', "%$keyword%")
                ->orWhere('subtitle', 'LIKE', "%$keyword%")
                ->orWhere('asin', 'LIKE', "%$keyword%")
                ->orWhere('subtitle', 'LIKE', "%$keyword%")
                ->orwhereIn('author', $author_arr)
                ->latest()->paginate($perPage);
        } 
        else 
        {
            $books = Book::latest()->paginate($perPage);
        }
        return view('books.search', compact('books', 'categories', 'search_text'));
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
        // $book = Book::findOrFail(252);
        $category = Category::findOrFail($book->category)->where('id', $book->category)->first();
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
        $currentUser = Auth::user();
        $categories  = Category::all();
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
            ->where('paid_ebook.book_id', '=', $id)
            ->get();
        if(!empty($currentUser) && $currentUser->isAdmin())
        {
            return view('books.edit', compact('book', 'categories', 'paid', 'paidDiscount', 'phone', 'username'));    
        }    
        else
        {   
            return view('books.saved_edit_ebook', compact('book', 'categories', 'username'));
        }
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
        return redirect('book/'.$id.'/edit')->with('flash_message', 'E-Book updated !');
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
            ->where('books.status', '=', 1)
            ->get(); 
       }
       else if($category_name == 'free-books' || $category_name == 'paid-books')
       {    
            $type = ($category_name == 'free-books') ? 'free' : 'paid';
            $records = DB::table('books')
                ->join('users', 'users.id', '=', 'books.user_id')
                ->join('categories', 'books.category', '=', 'categories.id')
                ->select('categories.*','books.*', 'users.first_name', 'users.last_name', 'users.name')
                ->where('categories.is_delete', '=', 0)
                ->where('categories.status', '=', 'Active')
                ->where('books.status', '=', 1)
                ->where('books.type', '=', $type)
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
                ->whereIn('books.status', array(1,2))
                ->get();
       }
       foreach ($records as $k => $v) 
       {
            $book_review_star = BookReview::where('book_id', '=', $v->id)->sum('star');
            $v->star = $book_review_star/5;
       } 
       $categories = Category::all(); $page = $category_name;
       $category_name = ($category_name == 'free-books' || $category_name == 'paid-books') ? 'all-books' : $category_name;
       $category = Category::where('category_slug', '=', $category_name)->first();
       $data = [ 'category_name' => $category_name, 'category' => $category, 'categories' => $categories, 'records' => $records ];
       if(!empty($currentUser) && $currentUser->isAdmin() && $page != 'free-books' && $page != 'paid-books')
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
     * View Free-Paid E-Book 
    */
    public function view_free_ebook($id)
    {   
        $book = Book::findOrFail($id)->where('id', $id);
        $book = $book->first(); 
        if($book->author && !empty($book->author) && is_numeric($book->author)){
            $author = User::findOrFail($book->author);
        }
        $book_star = BookReview::where('book_id', '=', $book->id)->sum('star');
        $book->star = $book_star/5;
        $paid = Book::findOrFail($id)->paid;
        $paidDiscount = DB::table('paid_discount')
        ->join('paid_ebook', function($join){
            $join->on('paid_discount.book_id', '=', 'paid_ebook.book_id')
            ->on('paid_discount.paid_ebook_id', '=', 'paid_ebook.id');
        })
        ->select('paid_discount.*', 'paid_ebook.store_logo', 'paid_ebook.store_name')
        ->where('paid_discount.book_id', '=', $id)
        ->where('paid_ebook.book_id', '=', $id)
        ->get();
        $related_book = DB::table('books')
        ->join('users', 'users.id', '=', 'books.user_id')
        ->join('categories', 'books.category', '=', 'categories.id')
        ->select('categories.*','books.*', 'users.first_name', 'users.last_name', 'users.name')
        ->where('categories.id', '=', $book->category)
        ->where('categories.is_delete', '=', 0)
        ->where('categories.status', '=', 'Active')
        ->where('books.status', '=', 1)
        ->get();
        foreach ($related_book as $k => $v) 
        {
            $book_review_star = BookReview::where('book_id', '=', $v->id)->sum('star');
            $v->star = $book_review_star/5;
        }
        $bookReview = BookReview::where('book_id', $id)->where('user_id', Auth::id())->first();
        $book_review_count = BookReview::where('book_id', $id)->count();
        $book_reviews = DB::table('book_reviews')
            ->join('users', 'users.id', '=', 'book_reviews.user_id')
            ->join('books', 'books.id', '=', 'book_reviews.book_id')
            ->select('book_reviews.*', 'books.author', 'books.publisher', 'users.first_name', 'users.last_name', 'users.name')
            ->where('book_reviews.book_id', '=', $id)
            ->get();
        return view('books.free_ebook', compact('book', 'related_book', 'paid', 'paidDiscount', 'bookReview', 'book_review_count', 'book_reviews', 'author'));
    }

    /**
     * Reading Free E-Book 
    */
    public function read_ebook($id)
    {   
        $currentUser = Auth::user();
        $book = Book::findOrFail($id)->where('id', $id);
        $book = $book->first();
        $chapters = array();
        if(!empty($book->book_content))
        {
            $chapters = json_decode($book->book_content->chapters, true);
        }
        $bookmarks = array();
        $bm_arr = array();
        if(!empty($book->bookmarks))
        {
            $bookmarks = $book->bookmarks;
            foreach ($bookmarks as $key => $value) {
               $bm_arr[] = $value->chapter_index+1;
            }
        }
        return view('books.read_ebook', compact('book', 'chapters', 'currentUser', 'bookmarks', 'bm_arr'));
    }

    /**
     * Save Book Chapters & Notes
    */
    public function saveContent(Request $request)
    {   
        $requestData  = $request->all(); 
        $book         = Book::findOrFail($requestData['id'])->update($requestData);
        $arrayChapter = array('book_id' => $requestData['id'], 'chapters' => json_encode($requestData['chapters']));
        $arrayNote    = array('book_id' => $requestData['id'], 'note' => json_encode($requestData['notes']));
        //Add/Update Chapters
        if(isset($requestData['bookContentID']))
            $bookContent  = BookContents::findOrFail($requestData['bookContentID'])->update($arrayChapter);
        else
            $bookContent  = BookContents::create($arrayChapter);
        //Add/Update Notes
        if(isset($requestData['bookNoteID']))
            $bookNotes = BookNotes::findOrFail($requestData['bookNoteID'])->update($arrayNote);
        else
            $bookNotes = BookNotes::create($arrayNote);
        return $requestData;
    }

    /**
     * Save Book Images
    */
    public function saveImage(Request $request)
    {
        $requestData = $request->all(); 
        if ($request->hasFile('ebook_image')) 
        {
            $uploadPath = public_path('/uploads/ebook_logo');
            $file = $request->file('ebook_image');
            $file->move($uploadPath, $file->getClientOriginalName());
            $requestData['image'] = $file->getClientOriginalName();
        }
        $book = BookImages::create($requestData); 
        return $book;
    }

    /*
     * Upload eBook Page
    */
    public function uploadEbookPage()
    {
        $currentUser = Auth::user();
        if(!$currentUser->isAdmin())
        {
            return redirect('home');  
        }
        $authors = User::where('status', 'active')->whereNotNull('plan_id')->get();
        
        $categories = Category::all();
        return view('books.upload', compact('categories', 'authors'));
    }

    /*
    * Upload E-book file admin section
    */
    public function uploadBook(Request $request)
    {
        $currentUser = Auth::user();
        $requestData = $request->all(); 
        if ($request->hasFile('ebook_logo')) 
        {
            $uploadPath = public_path('/uploads/ebook_logo');
            $file = $request->file('ebook_logo');
            $file->move($uploadPath, $file->getClientOriginalName());
            $requestData['ebook_logo'] = $file->getClientOriginalName();
        } 
        if ($request->hasFile('file_name')) 
        {
            $uploadPath = public_path('/uploads/ebook_logo');
            $file = $request->file('file_name');
            $file->move($uploadPath, $file->getClientOriginalName());
            $requestData['buyLink'] = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $requestData['book_ext'] = $extension;
        }
        if(!empty($currentUser) && $currentUser->isAdmin())
        {
            $requestData['user_id'] = (!empty($requestData['author'])) ? $requestData['author'] : $currentUser->id;
        }
        else
        {
            $requestData['user_id'] = $currentUser->id;
        }
        
        $requestData['type'] = (!empty($requestData['type'])) ? $requestData['type'] : 'free';
        $book = Book::create($requestData); 
        if(!empty($currentUser) && $currentUser->isAdmin())
        {
            if($requestData['type'] == 'paid')
            {
                return redirect('book/'.$book->id.'/edit');    
            }
            else
            {
                return redirect('admin/books/category/all-books')->with('flash_message', 'E-Book uploaded successfully !');    
            }
        }
        else
        {
            return redirect('book/publishebook')->with('flash_message', 'E-Book uploaded successfully !'); 
        }
    }

    /* GET Book Detail By ID */
    public function getBookDetail($id)
    {
        $categories  = Category::all();
        $book        = Book::findOrFail($id)->where('id', $id)->first();
        $category    = Category::findOrFail($book->category)->where('id', $book->category)->first();
        $bookContent = BookContents::where('book_id', $id)->first();
        $bookNote    = BookNotes::where('book_id', $id)->first();
        $bookImages  = BookImages::where('book_id', $id)->get();
        $result      = array('book' => $book, 'category' => $category, 'categories' => $categories, 'bookContent' => $bookContent, 'bookNote' => $bookNote, 'bookImages' => $bookImages);
        return $result;
    }

    /* 
     * Add Review for Book 
     */

    public function add_book_review(Request $request)
    {
        $requestData = $request->all();
        $book_review = BookReview::create($requestData);
        $book = Book::findOrFail($book_review->book_id)->where('id', $book_review->book_id);
        $book = $book->first();
        return redirect("books/ebook/$book->id/$book->ebooktitle");
    }

    /*
     * Author Page 
     */
    public function author_view_page($id, $authorid, $authorname)
    {
        $book = Book::findOrFail($id)->where('id', $id);
        $book = $book->first();

        $author = User::findOrFail($authorid);
        
        $related_book = DB::table('books')
        ->join('users', 'users.id', '=', 'books.user_id')
        ->join('categories', 'books.category', '=', 'categories.id')
        ->select('categories.*','books.*', 'users.first_name', 'users.last_name', 'users.name')
        ->where('categories.id', '=', $book->category)
        ->where('categories.is_delete', '=', 0)
        ->where('categories.status', '=', 'Active')
        ->where('books.status', '=', 1)
        ->get();
        $bookReview = BookReview::where('book_id', $id)->where('user_id', Auth::id())->first();
        return view('books.author', compact('book', 'related_book', 'bookReview', 'author'));
    }

    /*
    *   Publish E-Book Page View
    */

    public function publish_ebook_page()
    {
        $currentUser = Auth::user();
        $categories  = Category::all();
        return view('books.publish_ebook', compact('categories', 'currentUser'));
    }

    /*
    * Get View All books
    */

    public function view_all_books($category_name)
    {
        if($category_name == 'new_releases')
        {
            $books = HomeBook::with('home_books')->where('type', 'new_releases')->get();
        }
        else if($category_name == 'bestsellers')
        {
            $books = HomeBook::with('home_books')->where('type', 'bestsellers')->get();
        }
        else if($category_name == 'classics')
        {
            $books = HomeBook::with('home_books')->where('type', 'classics')->get();
        }
        else if($category_name == 'related_books')
        {
            $books = HomeBook::with('home_books')->where('type', 'classics')->get();
        }
        else if($category_name == 'featured_books')
        {
            $books = HomeBook::with('home_books')->where('type', 'classics')->get();
        }
        else if($category_name == 'trending_books')
        {
            $books = HomeBook::with('home_books')->where('type', 'classics')->get();
        }
        else if($category_name == 'non_fiction_books')
        {
            $books = HomeBook::with('home_books')->where('type', 'classics')->get();
        }
        foreach ($books as $k => $v) 
        {
            $book_review_star = BookReview::where('book_id', '=', $v->book_id)->sum('star');
            if(!empty($v->home_books))
                $v->home_books->star = $book_review_star/5;
        }
        return view('books.view-all', compact('category_name', 'books'));
    }
}