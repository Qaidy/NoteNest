<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NoteNest') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

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
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-900" x-data="{ sidebarOpen: false, profileDropdown: false }">
        <div class="flex h-screen overflow-hidden">
            
            <!-- Mobile sidebar backdrop -->
            <div x-show="sidebarOpen" class="fixed inset-0 z-40 bg-gray-900/80 lg:hidden" @click="sidebarOpen = false" style="display: none;"></div>

            <!-- Sidebar -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 flex flex-col bg-white dark:bg-gray-800 border-r border-gray-200/60 dark:border-gray-700/60 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 shadow-sm">
                
                <!-- Logo -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100 dark:border-gray-700/50">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-md">
                            <x-application-logo class="w-6 h-6 fill-current text-white" />
                        </div>
                        <span class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">NoteNest</span>
                    </a>
                    <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto py-6 px-4 space-y-8 no-scrollbar">
                    
                    <!-- Navigation -->
                    <div>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-purple-50 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white' }}">
                                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-purple-600 dark:text-purple-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                    Home
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('notes.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-colors {{ request()->routeIs('notes.*') ? 'bg-purple-50 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white' }}">
                                    <svg class="w-5 h-5 {{ request()->routeIs('notes.*') ? 'text-purple-600 dark:text-purple-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                    My Library
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium transition-colors {{ request()->routeIs('profile.*') ? 'bg-purple-50 dark:bg-purple-500/10 text-purple-700 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white' }}">
                                    <svg class="w-5 h-5 {{ request()->routeIs('profile.*') ? 'text-purple-600 dark:text-purple-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Setting
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- My Notes Section -->
                    <div>
                        <div class="px-3 mb-3 flex items-center justify-between">
                            <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">My Notes</h3>
                            <a href="{{ route('notes.create') }}" class="text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </a>
                        </div>
                        
                        @php
                            $recentNotes = auth()->check() ? auth()->user()->notes()->latest()->take(5)->get() : collect();
                        @endphp

                        <ul class="space-y-1">
                            @forelse($recentNotes as $sidebarNote)
                                <li>
                                    <a href="{{ route('notes.show', $sidebarNote) }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-white transition-colors group">
                                        <div class="w-2 h-2 rounded-full bg-purple-200 dark:bg-purple-900/50 group-hover:bg-purple-500 transition-colors"></div>
                                        <span class="truncate">{{ $sidebarNote->title }}</span>
                                    </a>
                                </li>
                            @empty
                                <li class="px-3 py-2 text-xs text-gray-400">No notes yet</li>
                            @endforelse
                        </ul>
                    </div>

                </div>



            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 bg-gray-50 dark:bg-gray-900">
                
                <!-- Navbar -->
                <header class="h-20 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-30 bg-gray-50/95 dark:bg-gray-900/95 border-b border-gray-200/50 dark:border-gray-800/50">
                    <div class="flex items-center gap-4 flex-1">
                        <button @click="sidebarOpen = true" class="lg:hidden p-2 text-gray-500 hover:text-gray-700 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-4 sm:gap-6">
                        <a href="{{ route('notes.create') }}" class="hidden sm:inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-purple-600 hover:from-indigo-600 hover:via-purple-600 hover:to-purple-700 text-white font-medium rounded-xl shadow-sm transition-all duration-200 text-sm transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            New Note
                        </a>

                        <x-theme-toggle />

                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button @click="profileDropdown = !profileDropdown" @click.away="profileDropdown = false" class="flex items-center gap-2 focus:outline-none">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff&rounded=true" alt="User avatar" class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-800 shadow-sm">
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="profileDropdown" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 py-1 z-50" style="display: none;">
                                <div class="px-4 py-2 border-b border-gray-100 dark:border-gray-700/50">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors">Log Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content Wrapper -->
                <main class="flex-1 overflow-y-auto p-4 sm:p-8">
                    <!-- Page Heading (Optional) -->
                    @isset($header)
                        <div class="max-w-7xl mx-auto mb-6">
                            {{ $header }}
                        </div>
                    @endisset

                    <!-- White Card Container -->
                    <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700/50 p-6 sm:p-10 min-h-[calc(100vh-12rem)]">
                        {{ $slot }}
                    </div>
                </main>

            </div>
        </div>
    </body>
</html>
