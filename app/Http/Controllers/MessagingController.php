<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\ConversationParticipant;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class MessagingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $conversations = $user->conversations()
            ->with([
                'users',
                'messages' => function ($q) {
                    $q->latest()->take(1);
                },
            ])
            ->get();
        return view('chat.multichat', compact('conversations'));
    }

    public function createConversation(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array|min:1',
            'title' => 'nullable|string',
        ]);

        $isGroup = count($request->input('user_ids')) > 1;
        $conversation = Conversation::create([
            'title' => $request->input('title') ?: null,
            'is_group' => $isGroup,
        ]);

        ConversationParticipant::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
        ]);
        foreach ($request->input('user_ids') as $uid) {
            ConversationParticipant::firstOrCreate([
                'conversation_id' => $conversation->id,
                'user_id' => $uid,
            ]);
        }

        return redirect("/chat/conversation/{$conversation->id}");
    }

    public function show($id)
    {
        $conversation = Conversation::with(['messages.user', 'users'])->findOrFail($id);
        return view('chat.conversation', compact('conversation'));
    }

    public function send(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);
        $conversation = Conversation::findOrFail($id);
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
            'message' => $request->input('message'),
        ]);
        broadcast(new MessageSent($message))->toOthers();
        return response()->json(['status' => 'ok', 'message' => $message]);
    }
}
