<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $setting = Setting::find(1);

        return view('admin.settings.edit', compact('setting'));
        // $keyword = $request->get('search');
        // $perPage = 25;

        // if (!empty($keyword)) {
        //     $settings = Setting::where('site_tite', 'LIKE', "%$keyword%")
        //         ->orWhere('site_meta_keyword', 'LIKE', "%$keyword%")
        //         ->orWhere('site_meta_desc', 'LIKE', "%$keyword%")
        //         ->orWhere('admin_email', 'LIKE', "%$keyword%")
        //         ->orWhere('from_email', 'LIKE', "%$keyword%")
        //         ->orWhere('from_name', 'LIKE', "%$keyword%")
        //         ->orWhere('site_logo', 'LIKE', "%$keyword%")
        //         ->orWhere('payment_api_key', 'LIKE', "%$keyword%")
        //         ->orWhere('payment_api_token', 'LIKE', "%$keyword%")
        //         ->latest()->paginate($perPage);
        // } else {
        //     $settings = Setting::latest()->paginate($perPage);
        // }

        // return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.settings.create');
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
        

        if ($request->hasFile('site_logo')) {
            foreach($request['site_logo'] as $file){
                $uploadPath = public_path('/uploads/site_logo');

                $extension = $file->getClientOriginalExtension();
                $fileName = rand(11111, 99999) . '.' . $extension;

                $file->move($uploadPath, $fileName);
                $requestData['site_logo'] = $fileName;
            }
        }

        Setting::create($requestData);

        return redirect('admin/settings')->with('flash_message', 'Setting added!');
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
        $setting = Setting::findOrFail($id);

        return view('admin.settings.show', compact('setting'));
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
        $setting = Setting::findOrFail($id);

        return view('admin.settings.edit', compact('setting'));
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
        if ($request->site_logo->getClientOriginalName()) {
            
            $uploadPath = public_path('/uploads/site_logo');

            $extension = $request->site_logo->getClientOriginalExtension();
            $fileName = 'ampleread_logo.' . $extension;

            $request->site_logo->move($uploadPath, $fileName);
            $requestData['site_logo'] = $fileName;
            }
        
        $setting = Setting::findOrFail($id);
        $setting->update($requestData);
        return redirect('admin/settings')->with('flash_message', 'Setting updated!');
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
        Setting::destroy($id);

        return redirect('admin/settings')->with('flash_message', 'Setting deleted!');
    }
}
