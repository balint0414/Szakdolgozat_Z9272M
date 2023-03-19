<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FriendRequest;
use Auth;

class FriendController extends Controller
{
    public function sendFriendRequest(Request $request)
    {
        $receiver = User::findOrFail($request->receiver_id);

        $friendRequest = FriendRequest::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver->id,
        ]);

        return back()->with('success', 'Barátkérelem sikeresen elküldve!');
    }

    public function acceptFriendRequest(Request $request)
    {
        $friendRequest = FriendRequest::where('sender_id', $request->sender_id)
        ->where('receiver_id', auth()->id())
        ->firstOrFail();

        $friendRequest->update(['is_accepted' => true]);

        return back()->with('success', 'Barátnak jelölés elfogadva!');
    }

    public function showRequests()
    {
        $friendRequests = FriendRequest::orderBy('created_at', 'desc')
        ->paginate(5);

        return view('friend.requests')->with(compact('friendRequests'));
    }

    public function showFriends()
    {
        $sentFriends= Auth::user()->sentFriends;
        $receivedFriends = Auth::user()->receivedFriends;
        $friends = $sentFriends->merge($receivedFriends);

        if ($friends->isEmpty()) {
            return view('friend.friends')->with('message', 'Nincs még egy barátod sem.');
        }

        return view('friend.friends')->with(compact('friends'));
    }
}
