<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use App\Category;
use Illuminate\Http\Request;
use App\Book;

class CategoriesController extends Controller
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

        if (!empty($keyword)) {
            $categories = Category::where('name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $categories = Category::latest()->paginate($perPage);
        }

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
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
        if(isset($requestData['category_id']) && !empty($requestData['category_id']))
        {
            $category = Category::findOrFail($requestData['category_id']);
            $requestData['is_home_display'] = 1;
            $category->update($requestData);
            return redirect('/admin/homepage')->with('flash_message', 'Category added for Homepage !');
        }
        else
        {
            // echo "<pre>";
            // print_r($requestData);
            // exit;

            //add subcategory
            if(!empty($requestData['parent_category_id']) && is_numeric($requestData['parent_category_id']))
            {
                $slug = str_slug($request->input('subcategory'), '-');
                $requestData['name'] = $request->input('subcategory');
                $requestData['parent'] = $requestData['parent_category_id'];
                $requestData['category_slug'] = $slug;
                Category::create($requestData);
            }
            else if(!empty($requestData['parent_category_id']) && is_string($requestData['parent_category_id']))
            {
                //add category
                if(!empty($requestData['name']))
                {
                    $slug = str_slug($request->input('name'), '-');
                    $requestData['category_slug'] = $slug;
                    $cat = Category::create($requestData);
                }

                //add subcategory
                if($cat->id && !empty($requestData['subcategory']))
                {
                    $slug = str_slug($request->input('subcategory'), '-');
                    $requestData['name'] = $request->input('subcategory');
                    $requestData['parent'] = $cat->id;
                    $requestData['category_slug'] = $slug;
                    Category::create($requestData);
                }

            }
            // $slug = str_slug($request->input('name'), '-');
            // $requestData['category_slug'] = $slug;
            // Category::create($requestData);
            //return redirect('admin/categories')->with('flash_message', 'Category added!');
            return redirect('/admin/books/category/all-books')->with('flash_message', 'Category added !');
        }
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
        $category = Category::findOrFail($id);

        return view('admin.categories.show', compact('category'));
    }

    public function getsubcategory($id)
    {
        $category = Category::where('status', 'Active')->where('parent', $id)->where('is_delete', '=', 0)->get();;
        return Response::json(array(
                    'success' => true,
                    'data'   => $category
                )); 
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
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
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
        
        $category = Category::findOrFail($id);
        $slug = str_slug($request->input('name'), '-');
        $requestData['category_slug'] = $slug;
        $category->update($requestData);
        return redirect('/admin/books/category/all-books')->with('flash_message', 'Category added !');
        // return redirect('admin/categories')->with('flash_message', 'Category updated!');
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
        Category::destroy($id);

        return redirect('admin/categories')->with('flash_message', 'Category deleted!');
    }

    // public function delete_category($category_name , $id)
    // {
    //     $book_ids = [];
    //     $category_slug = str_slug($category_name, '-');
    //     $books = Book::where('category', '=', $category_slug)->with('user_name')->get();
    //     foreach ($books as $key => $book) {
    //         # code...
    //         $book_ids[$key] = $book->id;
    //     }
    //     $requestDataBooks['is_delete'] = 1;
    //     $books->update($requestDataBooks);
    //     Category::where('id', $id)->update(array('is_delete' => '1'));
    //     if(!empty($book_ids))
    //     {
    //     Book::whereIn('id', $book_ids)->update(['is_delete' => '1']);
    //      }

    //     return redirect('admin/books/category/Classics')->with('flash_message', 'Category deleted!');
    // }
}
