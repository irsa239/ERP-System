@extends('layout')

@section('content')
<div class="flex h-[80vh] rounded-xl shadow-lg overflow-hidden border bg-white">
    
    {{-- Left Sidebar (Contacts) --}}
    <div class="w-1/4 bg-gray-100 border-r p-4 overflow-y-auto">
        <h2 class="text-xl font-bold mb-5">Contacts</h2>

        <ul class="space-y-4">
            @foreach($users as $user)
                <li>
                    <form method="GET" action="{{ route('chat') }}">
                        <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                        <button type="submit" class="flex items-center gap-3 w-full p-2 hover:bg-indigo-100 rounded-lg">
                            <div class="relative">
                                @if($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 bg-indigo-200 text-indigo-700 flex items-center justify-center rounded-full font-bold text-sm">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                            </div>
                            <div>
                                <div class="font-semibold text-sm">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">Online</div>
                            </div>
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- Main Chat Area --}}
    <div class="w-3/4 flex flex-col">
        
        {{-- Chat Header --}}
        <div class="bg-indigo-600 text-white px-5 py-4 flex justify-between items-center">
            <div>
                @if($receiverId)
                    <div class="font-bold text-lg">
                        Chat with {{ $users->where('id', $receiverId)->first()->name ?? '' }}
                    </div>
                    <div class="text-xs text-indigo-200">End-to-end encrypted</div>
                @else
                    <div>Select a user to start chat</div>
                @endif
            </div>

            @if($receiverId)
                <button onclick="clearChat('{{ $receiverId }}')" class="bg-red-500 hover:bg-red-600 text-sm px-4 py-1 rounded">
                    🗑️ Clear Chat
                </button>
            @endif
        </div>

        {{-- Messages --}}
        <div id="messageArea" class="flex-1 p-6 space-y-3 overflow-y-auto bg-gray-50">
            @forelse($messages as $msg)
                <div class="group relative max-w-[70%] px-4 py-2 rounded-2xl shadow 
                            {{ $msg->sender_id === auth()->id() ? 'ml-auto bg-indigo-600 text-white' : 'mr-auto bg-gray-200 text-gray-800' }}">
                    
                    {{-- Message Actions (only for sender) --}}
                    @if($msg->sender_id === auth()->id())
                        <div class="absolute top-0 right-0">
                            <button onclick="toggleMenu('{{ $msg->id }}')" class="text-white px-2">⋮</button>

                            <div id="menu-{{ $msg->id }}" class="absolute right-0 mt-2 bg-white border shadow rounded hidden">
                                <button onclick="editMessage('{{ $msg->id }}', `{{ addslashes($msg->message) }}`)" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                    ✏️ Edit
                                </button>
                                <button onclick="deleteMessage('{{ $msg->id }}')" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-100">
                                    🗑️ Delete
                                </button>
                            </div>
                        </div>
                    @endif

                    <p class="break-words pr-10" id="msg-{{ $msg->id }}">{{ $msg->message }}</p>
                    <div class="text-xs text-right mt-1">
                        {{ $msg->created_at->format('h:i A') }}
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 text-sm">Start messaging...</p>
            @endforelse
        </div>
{{-- Typing Indicator --}}
<div id="typingIndicator" class="px-6 py-2 text-sm text-gray-500 bg-white border-b hidden">
Typing...
</div>

{{-- Message Form --}}
<div class="flex-1 overflow-y-auto p-6 space-y-3 bg-gray-50" id="messageArea">
<form id="messageForm" class="flex items-center gap-2">
                @csrf
                <input type="hidden" id="receiverId" value="{{ $receiverId }}">
                <button type="button">📎</button>
                <input id="messageInput" type="text" class="flex-1 border rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-400" placeholder="Type a message..." required>
                <select id="emojiPicker" class="border rounded px-2 py-1 text-sm">
                    <option value="">😊</option>
                    <option value="😂">😂</option>
                    <option value="❤️">❤️</option>
                    <option value="👍">👍</option>
                    <option value="😢">😢</option>
                    <option value="😎">😎</option>
                </select>
                <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded-full hover:bg-indigo-700">Send</button>
            </form>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 bg-black/40 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg w-[90%] max-w-md">
        <h3 class="text-lg font-semibold mb-3">Edit Message</h3>
        <form id="editForm">
            @csrf @method('PUT')
            <input type="hidden" id="editMessageId">
            <textarea id="editMessageText" class="w-full border rounded px-3 py-2" rows="3" required></textarea>
            <div class="mt-4 flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="text-gray-600 px-4 py-2 border rounded">Cancel</button>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>

{{-- Scripts --}}
<script>
    const csrf = '{{ csrf_token() }}';
    const input = document.getElementById('messageInput');
    const receiverId = document.getElementById('receiverId').value;

    document.getElementById('messageForm').addEventListener('submit', function (e) {
        e.preventDefault();
        fetch("{{ route('messages.send') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
            body: JSON.stringify({ message: input.value, receiver_id: receiverId })
        }).then(() => location.reload());
    });

    document.getElementById('emojiPicker').addEventListener('change', function () {
        input.value += this.value;
        this.value = "";
        input.focus();
    });

    input.addEventListener('input', function () {
        document.getElementById('typingIndicator').style.display = this.value.trim() ? 'block' : 'none';
    });

    function toggleMenu(id) {
        document.querySelectorAll("[id^='menu-']").forEach(el => el.classList.add('hidden'));
        document.getElementById('menu-' + id).classList.toggle('hidden');
    }

    function deleteMessage(id) {
        if (confirm("Delete this message?")) {
            fetch(`/messages/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrf }
            }).then(res => res.json()).then(data => {
                if (data.success) location.reload();
                else alert('Delete failed');
            });
        }
    }

    function clearChat(id) {
        if (confirm("Clear the entire chat?")) {
            fetch(`/messages/clear/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrf }
            }).then(res => res.json()).then(data => {
                if (data.success) location.reload();
                else alert('Clear failed');
            });
        }
    }

    function editMessage(id, text) {
        document.getElementById('editMessageId').value = id;
        document.getElementById('editMessageText').value = text;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    document.getElementById('editForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const id = document.getElementById('editMessageId').value;
        const text = document.getElementById('editMessageText').value;

        fetch(`/messages/${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
            body: JSON.stringify({ message: text })
        }).then(res => res.json()).then(data => {
            if (data.success) location.reload();
            else alert('Update failed');
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('[id^="menu-"]') && !e.target.closest('button[onclick^="toggleMenu"]')) {
            document.querySelectorAll("[id^='menu-']").forEach(el => el.classList.add('hidden'));
        }
    });
</script>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fade-in 0.3s ease-in-out;
    }

    #messageArea::-webkit-scrollbar {
        width: 6px;
    }

    #messageArea::-webkit-scrollbar-thumb {
        background-color: #cbd5e0;
        border-radius: 10px;
    }
</style>
@endsection
