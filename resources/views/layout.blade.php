<!DOCTYPE html>
<html lang="en" x-data>
<head>
    <meta charset="UTF-8">
    <title>Zentro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased" x-data="{ results: [], query: '', show: false }">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside style="background-color: #07d5b6;" class="w-52 text-black flex-shrink-0 hidden md:block">
        <div class="p-6 text-2xl font-bold border-b border-white-700">
            Admin Panel
            <div id="clock" class="text-white-100 font-semibold"></div>
        </div>
        <nav class="p-4 space-y-2 text-sm">
    <a href="/dashboard" class="block px-4 py-2 rounded hover:bg-[#06c1a6]">Dashboard</a>
    <a href="/employees" class="block px-4 py-2 rounded hover:bg-[#06c1a6]">Employees</a>
    <a href="/attendance" class="block px-4 py-2 rounded hover:bg-[#06c1a6]">Attendance</a>
    <a href="/leaves" class="block px-4 py-2 rounded hover:bg-[#06c1a6]">Leave Applications</a>
    <a href="/salary" class="block px-4 py-2 rounded hover:bg-[#06c1a6]">Salary Generation</a>
    <a href="{{ route('performance.index') }}" class="block px-4 py-2 rounded hover:bg-[#06c1a6]">Performance Insight</a>
    <a href="/settings" class="block px-4 py-2 rounded hover:bg-[#06c1a6]">Settings</a>
    
</nav>

    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Top Navbar -->
        <nav class="bg-white shadow-md px-6 py-4 flex items-center justify-between sticky top-0 z-50">
            <div class="flex items-center gap-2">
                <img src="{{ asset('Images/logo4.png') }}" alt="Logo" class="h-16 w-18 object-cover rounded-full">
                <a href="{{ url('') }}" class="text-xl font-bold text-[#07d5b6] tracking-wide">Zentro</a>
                <nav class="hidden lg:flex gap-4 text-md font-medium text-gray-600 space-x-2 ml-24">
                    <a href="/home" class="hover:text-[#07d5b6]">Home</a>
                    <a href="/projects" class="hover:text-[#07d5b6]">Projects</a>
                    <a href="/reports" class="hover:text-[#07d5b6]">Reports</a>
                </nav>
            </div>

            <!-- Search -->
            <div class="hidden lg:block">
                <div class="relative w-[300px]" x-data="{ results: [], query: '', show: false }" @click.away="show = false">
                    <input
                        type="text"
                        x-model="query"
                        @input.debounce.300ms="
                            if (query.length > 0) {
                                fetch('/live-search?query=' + query)
                                    .then(res => res.json())
                                    .then(data => { results = data; show = true; });
                            } else {
                                results = []; show = false;
                            }
                        "
                        placeholder="Search here"
                        class="w-full border border-gray-300 rounded-full py-1 pl-3 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-[#07d5b6]"
                    >
                    <span class="absolute right-2 top-1.5 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                    </span>

                    <!-- Search Results -->
                    <div x-show="show && results.length > 0" x-cloak class="absolute bg-white border w-full mt-1 rounded shadow-lg max-h-64 overflow-y-auto z-50">
                        <template x-for="result in results" :key="result.url">
                            <a :href="result.url" class="block px-4 py-2 hover:bg-gray-100 text-sm">
                                <span class="font-semibold text-[#07d5b6]" x-text="result.type"></span>:
                                <span x-text="result.label"></span>
                            </a>
                        </template>
                    </div>

                    <!-- No Results -->
                    <div x-show="show && results.length === 0 && query.length > 0" x-cloak class="absolute bg-white border w-full mt-1 rounded px-4 py-2 text-sm text-gray-500 z-50">
                        No results found.
                    </div>
                </div>
            </div>

            <!-- Icons -->
            <div class="flex items-center gap-4">

                <!-- Notifications -->
                <div class="relative" x-data="{ showNotifications: false }">
                    <button @click="showNotifications = !showNotifications" class="relative focus:outline-none">
                        <svg class="w-6 h-6 text-gray-600 hover:text-[#07d5b6]" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 17h5l-1.4-1.4A2 2 0 0118 14.1V11a6 6 0 00-4-5.7V5a2 2 0 10-4 0v.3A6 6 0 006 11v3.1a2 2 0 01-.6 1.4L4 17h5m4 0v1a3 3 0 01-6 0v-1h6z"/>
                        </svg>
                        @if($unreadCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full px-1">{{ $unreadCount }}</span>
                        @endif
                    </button>

                    <div x-show="showNotifications" @click.away="showNotifications = false" x-transition
                         class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded shadow-xl z-50 max-h-72 overflow-y-auto text-sm" x-cloak>
                        <div class="p-3 border-b font-bold text-gray-800 flex justify-between items-center">
                            <span>Notifications</span>
                            @if($unreadCount > 0)
                                <form method="POST" action="{{ route('notifications.read.all') }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-xs text-[#07d5b6] hover:underline">Mark all as read</button>
                                </form>
                            @endif
                        </div>
                        @forelse($notifications->where('is_read', false) as $note)
                            <div class="px-4 py-2 border-b hover:bg-gray-100">
                                <div class="text-gray-800">{{ $note->message }}</div>
                                <div class="text-xs text-gray-500">{{ $note->created_at->diffForHumans() }}</div>
                                <form method="POST" action="{{ route('notifications.read', $note->id) }}">
                                    @csrf @method('PATCH')
                                    <button class="text-[#07d5b6] text-xs mt-1 hover:underline" type="submit">Mark as read</button>
                                </form>
                            </div>
                        @empty
                            <div class="px-4 py-2 text-gray-500">No new notifications.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Chat Icon -->
                <a href="{{ route('chat') }}" class="text-gray-600 hover:text-[#07d5b6]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h12a2 2 0 012 2z"/>
                    </svg>
                </a>

                <!-- Help -->
                <a href="{{ route('help') }}" class="text-gray-600 hover:text-[#07d5b6]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.325 4.317a1 1 0 01.352-.857l1.71-1.28a1 1 0 011.226 0l1.71 1.28a1 1 0 01.352.857v2.03a1 1 0 01-.352.857l-1.71 1.28a1 1 0 01-1.226 0l-1.71-1.28a1 1 0 01-.352-.857V4.317z" />
                        <path d="M4 12v2m16-2v2M6 22h12a2 2 0 002-2v-2H4v2a2 2 0 002 2z" />
                    </svg>
                </a>

                <!-- Profile -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-sm text-gray-700 focus:outline-none">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=07d5b6&color=000" alt="Avatar" class="w-8 h-8 rounded-full border border-black">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" >
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak x-transition class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg z-50 text-sm">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">My Profile</a>
                        <a href="register" class="block px-4 py-2 hover:bg-gray-100">Register</a>
                         <a href="events/create" class="block px-4 py-2 hover:bg-gray-100">Add Event</a>
                         <a href="employees" class="block px-4 py-2 hover:bg-gray-100">Add new employee</a>
                        
                        <form method="POST" action="">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">Logout</button>
                        </form>
                    </div>
                </div>

            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>

    </div>
</div>

<script>
    setInterval(() => {
        const now = new Date();
        document.getElementById('clock').textContent = now.toLocaleTimeString();
    }, 1000);
</script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>
</html>
