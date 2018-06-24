<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Home;
use App\Book;
use App\HomeBook;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $banner_images = Home::all();
        $books = Book::all();
        $home_books = HomeBook::with('home_books')->where('type', 'special_feature')->get();
        return view('admin.homepage', compact('banner_images','books','home_books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    // public function create()
    // {
    //     return view('admin.categories.create');
    // }

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
        if ($request->hasFile('home_logo')) 
        {
            $uploadPath = public_path('/uploads/ebook_logo');
            $file = $request->file('home_logo');
            $file->move($uploadPath, $file->getClientOriginalName());
            $requestData['image_name'] = $file->getClientOriginalName();
            $requestData['type'] = 'main_slider';
        }
        Home::create($requestData);
        return redirect('admin/homepage')->with('flash_message', 'Banner Image Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    // public function show($id)
    // {
    //     $category = Category::findOrFail($id);

    //     return view('admin.categories.show', compact('category'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    // public function edit($id)
    // {
    //     $banner_image_edit = Home::findOrFail($id);

    //     return view('admin.homepage', compact('banner_image_edit'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    // public function update(Request $request, $id)
    // {
        
    //     $requestData = $request->all();
        
    //     $category = Category::findOrFail($id);
    //     $category->update($requestData);

    //     return redirect('admin/categories')->with('flash_message', 'Category updated!');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Home::destroy($id);
        return redirect('admin/homepage')->with('flash_message', 'Banner deleted!');
    }
    
    /**
     * Add book to show in home page under special feature.
     *
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add_special_feature_book(Request $request)
    {
       $requestData = $request->all();
       if(isset($requestData['book_id']))
       {
        HomeBook::create($requestData);
        return redirect('admin/homepage')->with('flash_message', 'Special Feature Book Added !');
       }
       else
       {
        return redirect('admin/homepage')->with('flash_message', 'Select the book !');
       }
    }

    public function delete_special_feature_book($id)
    {
        HomeBook::destroy($id);
        return redirect('admin/homepage')->with('flash_message', 'Special feature book deleted !');
    }


    public function add_tags_book(Request $request)
    {
        $requestData = $request->all();
        if(isset($requestData['book_id']))
        {
            HomeBook::create($requestData);
            return redirect('admin/homepage')->with('flash_message', 'Book added to '.$requestData['type']);
        }
        else
        {
            return redirect('admin/homepage')->with('flash_message', 'Select the book');
        }
    }

    public function show_books_tag($category_name)
    {
        echo $category_name; die();
    }
}