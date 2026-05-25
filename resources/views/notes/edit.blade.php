<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('notes.index') }}" class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:border-gray-300 dark:hover:border-gray-600 transition-all duration-200 shadow-sm" title="Back to Notes">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">Edit Note</h1>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 overflow-hidden">
            <form action="{{ route('notes.update', $note) }}" method="POST" class="p-6 sm:p-8">
                @csrf
                @method('PATCH')

                <!-- Title Input -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $note->title) }}" 
                           class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition-all duration-200 @error('title') border-red-500 focus:ring-red-500/30 focus:border-red-500 @enderror"
                           placeholder="Give your note a title..." required autofocus />
                    @error('title')
                        <p class="mt-2 text-sm text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content Input -->
                <div class="mb-8">
                    <label for="content" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Content</label>
                    <textarea name="content" id="content" rows="12" 
                              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition-all duration-200 @error('content') border-red-500 focus:ring-red-500/30 focus:border-red-500 @enderror"
                              placeholder="Start typing your note here..." required>{{ old('content', $note->content) }}</textarea>
                    @error('content')
                        <p class="mt-2 text-sm text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-700/60">
                    <a href="{{ route('notes.index') }}" class="px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-semibold rounded-xl transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit" class="flex items-center justify-center gap-2 px-6 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold rounded-xl shadow-sm shadow-emerald-500/30 transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Update Note
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
