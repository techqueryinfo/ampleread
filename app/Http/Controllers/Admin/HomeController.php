<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Home;
use App\Book;
use App\HomeBook;
use Illuminate\Http\Request;
use DB;

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
        $categories = Category::where('is_delete', 0)->where('status', 'Active')->get();

        $books = Book::where('status', '2')->get();
        $home_books   = HomeBook::with('home_books')->where('type', 'special_feature')->get();
        $new_releases = HomeBook::with('home_books')->where('type', 'new_releases')->get();
        $active_category = Category::where('is_delete', 0)->where('is_home_display', 1)->where('status', 'Active')->first();
        if(!empty($active_category))
        {
            $active_category_slug = $active_category->category_slug;
            $home_books   = HomeBook::with('home_books')->where('type', $active_category->id)->get();
        }
        else
        {
            $active_category_slug = '';
            $home_books = array();
        }

        return view('admin.homepage', compact('banner_images','books','home_books', 'new_releases', 'count', 'categories', 'active_category', 'active_category_slug'));
    }

    public function delete_category($category_id)
    {
        if(empty($category_id))
        {
            return redirect('admin/homepage')->with('flash_message', 'Please select category!');
        }
        else
        {
            $category = Category::findOrFail($category_id);
            $requestData['is_home_display'] = 0;
            $category->update($requestData);

            DB::table('admin_special_features')->where('type', $category_id)->delete(); 

            return redirect('/admin/homepage')->with('flash_message', 'Category removed from Homepage !');
        }
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
            // $requestData['banner_link'] = 'banner_link';
            $requestData['type'] = 'main_slider';
        }
        if(!empty($requestData['banner_edit_id']))
        {
            $homeData = Home::findOrFail($requestData['banner_edit_id']);
            $homeData->update($requestData);
        }
        else{
            Home::create($requestData);
        }
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
        if ($request->hasFile('banner_image')) 
        {
            $uploadPath = public_path('/uploads/ebook_logo');
            $file = $request->file('banner_image');
            $file->move($uploadPath, $file->getClientOriginalName());
            $requestData['banner_image'] = $file->getClientOriginalName();
            // $requestData['banner_title'] = 'banner_link';
            // $requestData['type'] = 'main_slider';
        }
        if(!empty($requestData['sf_edit_id']))
        {
            $homeData = HomeBook::findOrFail($requestData['sf_edit_id']);
            $homeData->update($requestData);
        }
        else{
            HomeBook::create($requestData);
        }
        return redirect('admin/homepage')->with('flash_message', 'Special Feature Book Added !');
       }
    }

    /**
     * Delete special feature book admin end.
     *
     * @param $id
     */

    public function delete_special_feature_book($id)
    {
        HomeBook::destroy($id);
        return redirect('admin/homepage')->with('flash_message', 'Special feature book deleted !');
    }


    /**
     * Add books for frontend classics, new-realeases, bestsellers at admin end.
     *
     * @param $request form data
     */

    public function add_tags_book(Request $request)
    {
        $requestData = $request->all();
        $active_category = Category::where('is_delete', 0)->where('id', $requestData['type'])->where('status', 'Active')->first();        
        if(isset($requestData['book_id']))
        {
            HomeBook::create($requestData);
            return redirect('admin/homepage/'.$requestData['type'].'/'.$active_category->category_slug)->with('flash_message', 'Book added to '.$active_category->name);
        }
        else
        {
            return redirect('admin/homepage/'.$requestData['type'].'/'.$active_category->category_slug)->with('flash_message', 'Select the book');
        }
    }


    /**
     * Show books list for frontend classics, new-realeases, bestsellers.
     *
     * @param $category_name
     */

    public function show_books_tag($category_id, $category_slug)
    {
        $active_category_slug = $category_slug;
        $banner_images = Home::all();
        $categories = Category::where('is_delete', 0)->where('status', 'Active')->get();
        $active_category = Category::where('is_delete', 0)->where('id', $category_id)->where('status', 'Active')->first();

        $home_books   = HomeBook::with('home_books')->where('type', $category_id)->get();

        $books = Book::where('status', '2')->get();
        // $home_books =  Book::where('status', '2')->where('category', $category_id)->get();
        
        return view('admin.homepage', compact('banner_images','books','home_books', 'active_category_slug', 'categories', 'active_category'));
    }
}