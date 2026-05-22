<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NoteNest') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Theme Initialization Script to prevent FOUC -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <style>
        /* Custom Scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #374151;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #d1d5db;
        }
        .dark ::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }
        
        /* Hide scrollbar for sidebar but allow scrolling */
        .sidebar-scroll {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none;  /* Internet Explorer 10+ */
        }
        .sidebar-scroll::-webkit-scrollbar { 
            display: none;  /* Safari and Chrome */
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-900" x-data="{ sidebarOpen: false }">
    
    @php
        // View-level query to get notes for the sidebar without modifying the controller
        $sidebarNotes = auth()->check() ? auth()->user()->notes()->latest()->get() : collect();
        $currentNoteId = request()->route('note') ? request()->route('note')->id : null;
    @endphp

    <div class="flex h-screen overflow-hidden bg-white dark:bg-[#191919]">
        
        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-gray-900/80 lg:hidden" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 flex flex-col bg-[#f7f7f5] dark:bg-[#202020] border-r border-gray-200 dark:border-gray-800 transition-all duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            
            <!-- Sidebar Header / User Profile -->
            <div class="flex items-center justify-between px-4 py-4 h-16 border-b border-gray-200/50 dark:border-gray-800/50">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-white shadow-sm transition-shadow">
                        <span class="font-bold text-sm leading-none">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-200 leading-tight group-hover:text-violet-600 dark:group-hover:text-violet-400 transition-colors">{{ auth()->user()->name }}'s Nest</span>
                        <span class="text-[10px] text-gray-500 font-medium">Personal Notes</span>
                    </div>
                </a>
                
                <!-- Close Mobile Sidebar -->
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Notes List -->
            <div class="flex-1 overflow-y-auto sidebar-scroll py-4 px-3 space-y-1">
                <div class="px-3 mb-2 flex items-center justify-between text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                    <span>Your Notes</span>
                    <span class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 py-0.5 px-2 rounded-full text-[10px]">{{ $sidebarNotes->count() }}</span>
                </div>

                @forelse($sidebarNotes as $sidebarNote)
                    <a href="{{ route('notes.show', $sidebarNote) }}" 
                       class="group flex flex-col gap-1 px-3 py-2 text-sm rounded-lg transition-colors duration-150 {{ $currentNoteId == $sidebarNote->id ? 'bg-gray-200/60 dark:bg-gray-800/80 text-gray-900 dark:text-white font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-200/50 dark:hover:bg-gray-800/50 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0 opacity-70 group-hover:opacity-100 transition-opacity {{ $currentNoteId == $sidebarNote->id ? 'text-violet-500' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="truncate">{{ $sidebarNote->title }}</span>
                        </div>
                        @if($sidebarNote->tags && $sidebarNote->tags->isNotEmpty())
                            <div class="flex flex-wrap gap-1 pl-6">
                                @foreach($sidebarNote->tags->take(2) as $tag)
                                    <span class="text-[10px] px-1.5 py-0.5 bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 rounded">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                                @if($sidebarNote->tags->count() > 2)
                                    <span class="text-[10px] text-gray-400">...</span>
                                @endif
                            </div>
                        @endif
                    </a>
                @empty
                    <div class="px-3 py-4 text-xs text-gray-400 text-center">
                        No notes found
                    </div>
                @endforelse
            </div>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-gray-200/50 dark:border-gray-800/50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 w-full px-3 py-2 text-sm text-gray-600 dark:text-gray-400 rounded-lg hover:bg-gray-200/50 dark:hover:bg-gray-800/50 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Log Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden min-w-0 bg-white dark:bg-[#191919]">
            
            <!-- Topbar -->
            <header class="h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 bg-white/95 dark:bg-[#191919]/95 border-b border-gray-100 dark:border-gray-800/60 sticky top-0 z-30">
                <div class="flex items-center flex-1">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 mr-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    
                    <!-- Search Bar -->
                    <form action="{{ route('notes.index') }}" method="GET" class="hidden sm:flex items-center relative w-64 md:w-96 group">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 pointer-events-none group-focus-within:text-violet-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search notes..." class="w-full bg-gray-50 dark:bg-gray-800/50 border-0 text-sm text-gray-900 dark:text-gray-100 rounded-lg pl-9 pr-4 py-2 focus:ring-2 focus:ring-violet-500/50 focus:bg-white dark:focus:bg-gray-800 transition-all placeholder-gray-400">
                    </form>
                </div>

                <div class="flex items-center gap-3">
                    <x-theme-toggle />
                    <a href="{{ route('notes.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-violet-500 to-indigo-600 hover:from-violet-600 hover:to-indigo-700 text-white font-medium rounded-lg shadow-sm transition-all duration-200 text-sm">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        New Note
                    </a>
                </div>
            </header>

            <!-- Success Message Notification -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute top-20 right-8 z-50">
                    <div class="flex items-center gap-3 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-xl rounded-xl p-4 min-w-[300px]">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Success</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Main Scrollable Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-8 lg:p-12 relative">
                <div class="max-w-3xl mx-auto h-full">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
