@extends('layouts.app')

@section('content')
<h2>{{ $conversation->is_group ? ($conversation->title ?: 'Group Chat') : 'Chat' }}</h2>
<div id="messages" style="border:1px solid #ccc; padding:1rem; max-height:400px; overflow:auto;">
    @foreach($conversation->messages as $msg)
    <div class="message {{ auth()->id() === $msg->user_id ? 'own' : '' }}">
        <strong>{{ $msg->user->name }}:</strong> {{ $msg->message }} <small>({{ $msg->created_at->diffForHumans() }})</small>
    </div>
    @endforeach
</div>

<form id="sendForm">
    @csrf
    <input type="text" id="messageInput" placeholder="Type..." required style="width:70%;" />
    <button type="submit">Send</button>
</form>

<script>
    (() => {
        const token = document.querySelector('meta[name=csrf-token]').content;
        window.Echo = new window.Echo({
            broadcaster: 'reverb',
            csrfToken: token,
        });

        const convId = {
            {
                $conversation - > id
            }
        };
        window.Echo.private('conversation.' + convId)
            .listen('MessageSent', (e) => {
                const container = document.getElementById('messages');
                const div = document.createElement('div');
                div.innerHTML = '<strong>' + e.user.name + ':</strong> ' + e.message + ' <small>(' + e.created_at + ')</small>';
                container.appendChild(div);
                container.scrollTop = container.scrollHeight;
            });

        document.getElementById('sendForm').addEventListener('submit', async (ev) => {
            ev.preventDefault();
            const msg = document.getElementById('messageInput').value;
            if (!msg) return;
            await fetch('/chat/conversation/' + convId + '/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: msg
                })
            });
            document.getElementById('messageInput').value = '';
        });
    })();
</script>
@endsection