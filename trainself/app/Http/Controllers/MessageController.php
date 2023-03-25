<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FriendRequest;
use App\Models\Message;
use Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::where('recipient_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        
        return view('message.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$users = User::where('id', '!=', Auth::user()->id)->get();
        
        $sentFriends= Auth::user()->sentFriends;
        $receivedFriends = Auth::user()->receivedFriends;
        $friends = $sentFriends->merge($receivedFriends)->pluck('name', 'id');

        $recipientId = $request->input('recipient_id');

        return view('message.create', compact('friends', 'recipientId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required',
            'body' => 'required',
            'recipient_id' => 'required|exists:users,id',
        ]);

        $message = Message::create([
            'subject' => $data['subject'],
            'body' => $data['body'],
            'sender_id' => Auth::user()->id,
            'recipient_id' => $data['recipient_id'],
        ]);

        return redirect()->route('messages.index')->with('success', 'Üzenet sikeresen elküldve!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        /*
        if($message->recipient_id != Auth::user()->id)
        {
            abort(403);
        }
        */

        if($message->recipient_id == Auth::user()->id)
        {
            $message->read_at = now();
        }
        $message->save();

        return view('message.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        if($message->sender_id === Auth::user()->id || $message->recipient_id === Auth::user()->id)
        {
            $message->delete();

            return redirect()->route('messages.index')->with('success', 'Sikeresen törölted az üzenetet!');
        }
        else
        {
            return abort(403);
        }
    }

    public function sent()
    {
        $messages = Message::where('sender_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        
        return view('message.index', compact('messages'));
    }

    public function received()
    {
        $messages = Message::where('recipient_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('message.index', compact('messages'));
    }
}
