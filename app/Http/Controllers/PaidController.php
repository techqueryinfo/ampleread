<?php

namespace App\Http\Controllers;

use App\Category;
use App\Book;
use App\Paid;
use App\PaidDiscount;
use Illuminate\Http\Request;

class PaidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
    	$categories = Category::all();
    	$books = Book::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
    	
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
        if ($request->hasFile('store_logo')) 
        {
            $uploadPath = public_path('/uploads/storeimage');
            $file = $request->file('store_logo');
            $file->move($uploadPath, $file->getClientOriginalName());
            $requestData['store_logo'] = $file->getClientOriginalName();
        } 
        
        Paid::create($requestData);
        return redirect('book/'.$requestData['book_id'].'/edit')->with('flash_message', 'E-Book updated !');
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
        $paid = Paid::findOrFail($id);
        $paid->update($requestData);
        return redirect('book')->with('flash_message', 'Store Link Updated!');
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
        $user = Paid::find($id);
        $user->discount()->delete();
        $user->delete();
        return redirect('book')->with('flash_message', 'Store deleted for "'.$id.'"!');
    }

    /**
     * Store a newly created discount resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function discountSave(Request $request)
    {
        $requestData = $request->all();
        PaidDiscount::create($requestData);
        return redirect('book/'.$requestData['book_id'].'/edit')->with('flash_message', 'Discount added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteDiscount($id)
    {
        PaidDiscount::destroy($id);
        return redirect('book')->with('flash_message', 'Discount deleted successfully.');
    }
}