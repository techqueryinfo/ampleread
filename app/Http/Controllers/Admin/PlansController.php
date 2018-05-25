<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Plan;
use Illuminate\Http\Request;
use App\Transaction;

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
    
    /**
     * Get all plans to show in front end for users.
     *
     *
     * @return \Illuminate\View\View
     */
    public function fe_view_plans()
    {
        $plans = Plan::all();

        return view('fe_views.fe_view_plans', compact('plans'));
    }

    public function do_payment(Request $request)
    {
        // print_r($request->input()); exit();
        $currentUser = \Auth::user();
        
        \Twocheckout::privateKey('554071C2-1333-4224-B04D-C518659924B8');
        \Twocheckout::sellerId('901379979');
        \Twocheckout::sandbox(true);
        \Twocheckout::verifySSL(false);

        try {
            $charge = \Twocheckout_Charge::auth(array(
                "merchantOrderId" => "123",
                "token"      => $request->input('token'),
                "currency"   => 'USD',
                "total"      => $request->input('charge_value'),
                "billingAddr" => array(
                    "name" => $request->input('cardholdername'),
                    "addrLine1" => $request->input('street'),
                    "city" => $request->input('city'),
                    "state" => $request->input('state'),
                    "zipCode" => $request->input('zip'),
                    "country" => $request->input('country'),
                    "email" => $request->input('email'),
                    "phoneNumber" => '555-555-5555'
                    )
                ));

            if ($charge['response']['responseCode'] == 'APPROVED') {
                $requestData = array(
                    'plan_id' => $request->input('plan_id'),
                    'user_id' => $currentUser->id,
                    'merchantOrderId' => $charge['response']['merchantOrderId'],
                    'price' => $charge['response']['total'],
                    'currencyCode' => $charge['response']['currencyCode'],
                    'transactionId' => $charge['response']['transactionId'],
                    'orderNumber' => $charge['response']['orderNumber'],

                    );
                Transaction::create($requestData);
                $currentUser->plan_id = $request->input('plan_id');
                $currentUser->save();

                return redirect('profile/'.$currentUser->name)->with('success', 'Payment done successfully !');
                // echo "Thanks for your Order!";
                // echo "<h3>Return Parameters:</h3>";
                // echo "<pre>";
                // print_r($charge);
                // echo "</pre>";

            }
        } catch (Twocheckout_Error $e) {print_r($e->getMessage());}
    }

    /**
     * Get all plan transactions to show admin
     *
     *
     * @return \Illuminate\View\View
     */
    public function transactionView()
    {
        $transaction = Transaction::with('userRecord')->get();
        $transaction_new = Transaction::with('plan_transaction')->get();
        $trans = (array)$transaction;
        $trans_new = (array)$transaction_new;
        $result = array_merge($trans, $trans_new);
        //echo "<pre>"; print_r($result); exit(); 
        return view('admin.plans.transaction', compact('result'));
    }
}
