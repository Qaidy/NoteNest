<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="text-center sm:text-left">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 mb-6">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Welcome back, {{ Auth::user()->name }}!</h3>
        <p class="text-gray-500 dark:text-gray-400 mb-8">You are successfully logged in. Check out your latest notes or create a new one.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Quick Action Card 1 -->
            <a href="{{ route('notes.create') }}" class="flex items-start gap-4 p-5 rounded-2xl border border-gray-100 dark:border-gray-700/50 bg-gray-50 dark:bg-gray-800/50 hover:bg-purple-50 dark:hover:bg-purple-900/10 transition-colors group">
                <div class="p-3 rounded-xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 group-hover:border-purple-200 dark:group-hover:border-purple-800 transition-colors">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-1 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">Write a Note</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Capture a quick thought or idea right now.</p>
                </div>
            </a>

            <!-- Quick Action Card 2 -->
            <a href="{{ route('notes.index') }}" class="flex items-start gap-4 p-5 rounded-2xl border border-gray-100 dark:border-gray-700/50 bg-gray-50 dark:bg-gray-800/50 hover:bg-purple-50 dark:hover:bg-purple-900/10 transition-colors group">
                <div class="p-3 rounded-xl bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700 group-hover:border-purple-200 dark:group-hover:border-purple-800 transition-colors">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-1 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">View Library</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Browse and manage all your saved notes.</p>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
