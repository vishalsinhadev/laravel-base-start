<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->latest()->take(50)->get()->reverse();
        return view('chat.index', ['messages' => $messages]);
    }

    public function send(Request $request)
    {
        $request->validate(['message' => 'required|string|max:1000']);
        $user = Auth::user();
        $message = Message::create([
            'user_id' => $user->id,
            'message' => $request->input('message'),
        ]);
        broadcast(new MessageSent($message->load('user')))->toOthers();
        return response()->json(['status' => 'ok', 'message' => $message]);
    }
}
