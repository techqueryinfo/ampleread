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
        $users = User::where('status', '=', 'Active')->get();
        return $users;
    }

    /*
    * Get Message List
    */
    public function get_all_messages()
    {
        $messages = ChatMessages::select('users.first_name', 'users.last_name', 'chat_messages.user_id','chat_messages.admin_id', 'users.id', 'users.name', 'users.created_at')
            ->join('users','users.id','=','chat_messages.user_id')
            ->groupBy('chat_messages.user_id')
            ->orderBy('chat_messages.created_at', 'DESC')
            ->get();
        return $messages;
    }

    /*
    * Get Message List By User ID
    */
    public function get_user_messages($userId)
    {
        $user_messages = ChatMessages::where('user_id', $userId)
            ->orderBy('chat_messages.created_at', 'DESC')
            ->get();
        return $user_messages;
    }
}