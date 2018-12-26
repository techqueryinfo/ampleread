<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Message;
use App\ChatMessages;
use DB;

class AdminMessageController extends Controller
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
    public function index()
    {
        return view('message.index');
    }

    /**
    * Display a User End Message Chat View
    *
    *
    */
    public function front_message_view()
    {
        return view('message.front');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    /*
    * Get all Users list
    */
    public function get_all_users()
    {
        // $users = User::where('status', '=', 'Active')->where('id', '!=', 1)->get();
        // foreach ($users as $k => $v) 
        // {
        //     $array[] = $v;
        // }
        //echo "<pre>"; print_r($array); echo "</pre>"; die();
        // return $array;
        $messages = User::select('users.first_name', 'users.last_name', 'users.id', 'users.id as user_id', 'users.name', 'users.created_at', 'profiles.avatar')
            ->join('profiles','users.id','=','profiles.user_id')
            ->where('users.status', '=', 'Active')->where('users.id', '!=', 1)
            ->get();
            // echo "<pre>"; print_r($messages); echo "</pre>"; die();
        return $messages;
    }

    /*
    * Get Message List
    */
    public function get_all_messages()
    {
        $messages = ChatMessages::select('users.first_name', 'users.last_name', 'chat_messages.user_id','chat_messages.admin_id', 'users.id', 'users.name', 'users.created_at', DB::raw('DATE_FORMAT(chat_messages.updated_at, "%h:%i %p") as formattedDate'), 'profiles.avatar')
            ->join('users','users.id','=','chat_messages.user_id')
            ->join('profiles','users.id','=','profiles.user_id')
            ->groupBy('chat_messages.user_id')
            ->orderBy('chat_messages.created_at', 'DESC')
            ->limit(10)
            ->get();
        return $messages;
    }

    /*
    * Get Message List By User ID
    */
    public function get_user_messages($userId)
    {
        $user_messages = ChatMessages::where('user_id', $userId)
            ->orderBy('chat_messages.created_at', 'ASC')
            ->get();
        return $user_messages;
    }

    /*
    * Save admin message
    */
    public function save_admin_message(Request $request)
    {
        $requestData = $request->all();
        $chat_message = ChatMessages::create($requestData);
        return $chat_message;
    }
}