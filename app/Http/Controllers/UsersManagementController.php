<?php


namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Http\Requests;
use App\Traits\CaptureIpTrait;
use Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;
use App\Country;
use App\Plan;

ini_set('memory_limit', '1024M'); // or you could use 1G

class UsersManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $searchText = '';
        $users = User::where('deleted_at', '=' , null);
        if($request->input('user_search_box') && !empty($request->input('user_search_box')))
        {
            $searchText = $request->input('user_search_box');
            $users = $users->where('name', 'LIKE', '%' . $searchText . '%')
            ->orWhere('email', 'LIKE', '%' . $searchText . '%');
            // $users->appends(['search' => $q]);    
        }
        
        $users = $users->paginate(env('USER_LIST_PAGINATION_SIZE'));
        $roles = Role::all();
        return View('usersmanagement.show-users', compact('users', 'roles', 'searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $countries = Country::all();
        $plans = Plan::all();
        $data = [
            'roles' => $roles,
            'countries' => $countries,
            'plans' => $plans
        ];

        return view('usersmanagement.create-user')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('is_author') == 1)
        {
            $validator = Validator::make($request->all(),
                [
                    'name'                  => 'required|max:255|unique:users',
                    'role'                  => 'required',
                    'country_id'                  => 'required',
                ],
                [
                    'name.unique'         => trans('auth.userNameTaken'),
                    'name.required'       => trans('auth.userNameRequired'),
                    'country_id'          => 'required',
                    'role.required'       => trans('auth.roleRequired'),
                ]);
            
        }
        else
        {
            $validator = Validator::make($request->all(),
                [
                    'name'                  => 'required|max:255|unique:users',
                    'email'                 => 'required|email|max:255|unique:users',
                    'password'              => 'required|min:6|max:20|confirmed',
                    'password_confirmation' => 'required|same:password',
                    'role'                  => 'required',
                    'country_id'                  => 'required',
                ],
                [
                    'name.unique'         => trans('auth.userNameTaken'),
                    'name.required'       => trans('auth.userNameRequired'),
                    'country_id'          => 'required',
                    'email.required'      => trans('auth.emailRequired'),
                    'email.email'         => trans('auth.emailInvalid'),
                    'password.required'   => trans('auth.passwordRequired'),
                    'password.min'        => trans('auth.PasswordMin'),
                    'password.max'        => trans('auth.PasswordMax'),
                    'role.required'       => trans('auth.roleRequired'),
                ]
            );
        }
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $ipAddress = new CaptureIpTrait();
        $profile = new Profile();
        $email = ($request->input('is_author') == 1) ? time().'@mailinator.com' : $request->input('email');
        $user = User::create([
            'name'             => $request->input('name'),
            'first_name'       => $request->input('first_name'),
            'last_name'        => $request->input('last_name'),
            'email'            => $email,
            'country_id'       => $request->input('country_id'),
            'plan_id'          => $request->input('plan_id'),
            'password'         => ($request->input('password')) ? bcrypt($request->input('password')) : bcrypt(time()),
            'token'            => str_random(64),
            'admin_ip_address' => $ipAddress->getClientIp(),
            'activated'        => 1,
            'is_author'        => $request->input('is_author'),
            'about_us'         => $request->input('about_us')
        ]);

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');

            $fileName = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/avatar');

            $image->move($destinationPath, $fileName);

            $profile['avatar'] = $fileName;
            $profile['avatar_status'] = 1;  
        }

        $user->profile()->save($profile);
        $user->attachRole($request->input('role'));
        $user->save();

        return redirect('users')->with('success', trans('usersmanagement.createSuccess'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('usersmanagement.show-user')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $countries = Country::all();
        $plans = Plan::all();

        foreach ($user->roles as $user_role) {
            $currentRole = $user_role;
        }

        $data = [
            'user'        => $user,
            'roles'       => $roles,
            'currentRole' => $currentRole,
            'countries' => $countries,
            'plans' => $plans
        ];

        return view('usersmanagement.edit-user')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currentUser = Auth::user();
        $user = User::find($id);
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);
        $ipAddress = new CaptureIpTrait();
        if($request->input('is_author') == 1)
        {
            $validator = Validator::make($request->all(),
                [
                    'name'                  => 'required|max:255',
                    'country_id'                  => 'required',
                ],
                [
                    'name.required'       => trans('auth.userNameRequired'),
                    'country_id'          => 'required',
                ]);
            
        }
        else
        {
            if ($emailCheck) {
                $validator = Validator::make($request->all(), [
                    'name'     => 'required|max:255',
                    'email'    => 'email|max:255|unique:users',
                    'password' => 'present|confirmed|min:6',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'name'     => 'required|max:255',
                    'password' => 'nullable|confirmed|min:6',
                ]);
            }
        }
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->is_author = $request->input('is_author');

        if (!empty($request->input('counry_id'))) {
            $user->country_id = $request->input('counry_id');
        }

        if (!empty($request->input('plan_id'))) {
            $user->plan_id = $request->input('plan_id');
        }

        if (!empty($request->input('status'))) {
            $user->status = $request->input('status');
        }

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
        }
        if ($request->input('about_us') != null) {
            $user->about_us = $request->input('about_us');
        }

        $userRole = $request->input('role');
        if ($userRole != null) {
            $user->detachAllRoles();
            $user->attachRole($userRole);
        }

        $user->updated_ip_address = $ipAddress->getClientIp();

        switch ($userRole) {
            case 3:
                $user->activated = 0;
                break;

            default:
                $user->activated = 1;
                break;
        }

        $user->save();        
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');

            $fileName = $user->profile->id.'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/avatar');

            $image->move($destinationPath, $fileName);

            $profile['avatar'] = $fileName;
            $profile['avatar_status'] = 1;  
            $setting = Profile::findOrFail($user->profile->id);
            $setting->update($profile);
        }

        

        return back()->with('success', trans('usersmanagement.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);
        $ipAddress = new CaptureIpTrait();

        if ($user->id != $currentUser->id) {
            $user->deleted_ip_address = $ipAddress->getClientIp();
            $user->save();
            $user->delete();

            return redirect('users')->with('success', trans('usersmanagement.deleteSuccess'));
        }

        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }

    /**
     * Method to search the users.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('user_search_box');
        $searchRules = [
            'user_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'user_search_box.required' => 'Search term is required',
            'user_search_box.string'   => 'Search term has invalid characters',
            'user_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = User::where('id', 'like', $searchTerm.'%')
                            ->orWhere('name', 'like', $searchTerm.'%')
                            ->orWhere('email', 'like', $searchTerm.'%')->get();

        // Attach roles to results
        foreach ($results as $result) {
            $roles = [
                'roles' => $result->roles,
            ];
            $result->push($roles);
        }

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
