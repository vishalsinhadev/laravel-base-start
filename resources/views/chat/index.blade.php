@extends('layouts.app')

@section('content')
<div class="chat-box">
    <div id="messages">
        @foreach($messages as $msg)
            <div class="message {{ auth()->id() === $msg->user_id ? 'own' : '' }}">
                <strong>{{ $msg->user->name }}:</strong> {{ $msg->message }} <small>({{ $msg->created_at->diffForHumans() }})</small>
            </div>
        @endforeach
    </div>
    <form id="sendForm" style="margin-top:1rem;">
        @csrf
        <input type="text" name="message" id="messageInput" placeholder="Type..." autocomplete="off" style="width:70%;" required />
        <button type="submit">Send</button>
    </form>
</div>

<script>
    // Simple Echo + Reverb setup
    // Assumes Reverb is running via `php artisan websockets` or Reverb's server (if installed)
    // Using Laravel Echo global script
    (() => {
        const token = document.querySelector('meta[name=csrf-token]').content;
        // Initialize Echo for Reverb:
        window.Echo = new window.Echo({
            broadcaster: 'reverb',
            // no config needed for default local use
            csrfToken: token,
        });

        window.Echo.private('chat')
            .listen('MessageSent', (e) => {
                const container = document.getElementById('messages');
                const div = document.createElement('div');
                div.className = 'message' + (window.Laravel.user.id === e.user.id ? ' own' : '');
                div.innerHTML = '<strong>' + e.user.name + ':</strong> ' + e.message + ' <small>(' + e.created_at + ')</small>';
                container.appendChild(div);
                window.scrollTo(0, document.body.scrollHeight);
            });

        document.getElementById('sendForm').addEventListener('submit', async (ev) => {
            ev.preventDefault();
            const msg = document.getElementById('messageInput').value;
            if (!msg) return;
            const res = await fetch('/messages', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: msg })
            });
            document.getElementById('messageInput').value = '';
        });
    })();
</script>
@endsection
