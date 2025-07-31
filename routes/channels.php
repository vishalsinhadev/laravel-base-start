<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('conversation.{id}', function ($user, $id) {
    return \App\Models\ConversationParticipant::where('conversation_id', $id)
        ->where('user_id', $user->id)
        ->exists() ? ['id' => $user->id, 'name' => $user->name] : false;
});
