<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
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
            $plans = Plan::where('name', 'LIKE', "%$keyword%")
                ->orWhere('desc', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('access_time_period', 'LIKE', "%$keyword%")
                ->orWhere('access_period_type', 'LIKE', "%$keyword%")
                ->orWhere('no_of_book_download', 'LIKE', "%$keyword%")
                ->orWhere('publish_submit_book', 'LIKE', "%$keyword%")
                ->orWhere('read_ebook_directly', 'LIKE', "%$keyword%")
                ->orWhere('create_books', 'LIKE', "%$keyword%")
                ->orWhere('share_books', 'LIKE', "%$keyword%")
                ->orWhere('access_discount', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $plans = Plan::latest()->paginate($perPage);
        }

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.plans.create');
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
        $this->validate($request, [
			'"name' => 'min:2, amount'
		]);
        $requestData = $request->all();
        
        Plan::create($requestData);

        return redirect('admin/plans')->with('flash_message', 'Plan added!');
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
        $plan = Plan::findOrFail($id);

        return view('admin.plans.show', compact('plan'));
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
        $plan = Plan::findOrFail($id);

        return view('admin.plans.edit', compact('plan'));
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
        $this->validate($request, [
			'"name' => 'min:2, amount'
		]);
        $requestData = $request->all();
        
        $plan = Plan::findOrFail($id);
        $plan->update($requestData);

        return redirect('admin/plans')->with('flash_message', 'Plan updated!');
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
        Plan::destroy($id);

        return redirect('admin/plans')->with('flash_message', 'Plan deleted!');
    }
}
