<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $receiverId = $request->receiver_id ?? null;

        // Fetch messages between users
        $messages = [];
        if ($receiverId) {
            $messages = Message::where(function ($query) use ($receiverId) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $receiverId);
            })->orWhere(function ($query) use ($receiverId) {
                $query->where('sender_id', $receiverId)
                      ->where('receiver_id', Auth::id());
            })->orderBy('created_at')->get();
        }

        return view('chat', compact('users', 'receiverId', 'messages'));
    }

    public function fetchMessages($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message'     => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message'     => $request->message,
        ]);

        return response()->json($message);
    }
    public function clearChat($receiverId)
{
    // Auth user's messages between the receiver
    Message::where(function ($query) use ($receiverId) {
        $query->where('sender_id', Auth::id())
              ->where('receiver_id', $receiverId);
    })->orWhere(function ($query) use ($receiverId) {
        $query->where('sender_id', $receiverId)
              ->where('receiver_id', Auth::id());
    })->delete();

    return response()->json(['success' => true, 'message' => 'Chat cleared.']);
}


    // ✅ Update message
    public function update(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = Message::where('id', $id)
                          ->where('sender_id', Auth::id()) // Only allow self messages to edit
                          ->firstOrFail();

        $message->update([
            'message' => $request->message
        ]);

        return response()->json(['success' => true, 'message' => 'Message updated.']);
    }

    // ✅ Delete message
    public function destroy($id)
    {
        $message = Message::where('id', $id)
                          ->where('sender_id', Auth::id()) // Only allow self messages to delete
                          ->firstOrFail();

        $message->delete();

        return response()->json(['success' => true, 'message' => 'Message deleted.']);
    }
}
