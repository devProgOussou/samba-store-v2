<?php

namespace App\Http\Controllers\Message;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Inertia\Inertia;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $message = new Message();
        $message->sender_id = Auth::user()->id;
        $message->receiver_id = $request->input('id');
        $message->message = $request->input('message');
        $message->user_id = Auth::user()->id;
        $message->save();
        // return redirect()->route('message.displayAllMessage');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function show($id)
    {
        $messageSend = Message::with('user')->where('sender_id', Auth::user()->id)->orderBy('created_at', 'asc')->get();
        // dd($messageSend);
        $messages = Message::with('user')->where('sender_id', $id)->orderBy('created_at', 'asc')->get();
        // dd($messages);
        return Inertia::render('User/displayMessage', [
            'messages' => $messages,
            'messageSend' => $messageSend
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function displayAllMessage()
    {
        $messages = Message::with('user')->where('receiver_id', Auth::user()->id)->get();
        $users = User::with('messages')->where('id', Auth::user()->id)->orderBy("id", "desc")->get();
        // dd($users);
        return Inertia::render('User/Message', [
            'messages' => $messages,
            'users' => $users
        ]);
    }

    public function displayMessage()
    {
        $messages = Message::with('user')->where('receiver_id', Auth::user()->id)->get();
        return Inertia::render('User/displayMessage', [
            'messages' => $messages
        ]);
    }
}
