@extends('layouts.app')

@section('content')
<h2>Your Conversations</h2>

<div style="max-width:800px; margin:auto;">
    <div style="margin-bottom:1rem; padding:1rem; border:1px solid #ddd;">
        <form method="POST" action="/chat/conversation">
            @csrf
            <label><strong>Start direct chat with:</strong></label>
            <select name="user_ids[]" required>
                @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $other)
                <option value="{{ $other->id }}">{{ $other->name }} ({{ $other->email }})</option>
                @endforeach
            </select>
            <input type="hidden" name="title" value="">
            <button type="submit" style="margin-left:0.5rem;">Start Chat</button>
        </form>
    </div>

    @if($conversations->isEmpty())
    <div>No conversations yet.</div>
    @else
    <ul style="list-style:none; padding:0;">
        @foreach($conversations as $conv)
        @php
        // get other participants' names
        $others = $conv->users->filter(fn($u) => $u->id !== auth()->id())->pluck('name')->toArray();
        $title = $conv->is_group
        ? ($conv->title ?: 'Group Chat #' . $conv->id)
        : (count($others) ? $others[0] : 'Me');
        $lastMessage = $conv->messages->sortByDesc('created_at')->first();
        @endphp
        <li style="margin-bottom:1rem; border:1px solid #ccc; padding:0.75rem; display:flex; justify-content:space-between;">
            <div>
                <a href="/chat/conversation/{{ $conv->id }}"><strong>{{ $title }}</strong></a><br>
                <small>
                    @if($lastMessage)
                    <em>{{ $lastMessage->user->name }}:</em> {{ \Illuminate\Support\Str::limit($lastMessage->message, 50) }} · {{ $lastMessage->created_at->diffForHumans() }}
                    @else
                    <em>No messages yet</em>
                    @endif
                </small>
            </div>
            <div>
                @if($conv->is_group)
                <span style="background:#eef; padding:2px 6px; border-radius:4px;">Group</span>
                @else
                <span style="background:#efe; padding:2px 6px; border-radius:4px;">Direct</span>
                @endif
            </div>
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection