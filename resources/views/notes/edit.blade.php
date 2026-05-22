<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('notes.index') }}" class="p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400 rounded-lg transition duration-150" title="Back to Notes">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Edit Note') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-gray-700/60">
                <form action="{{ route('notes.update', $note) }}" method="POST" class="p-8">
                    @csrf
                    @method('PATCH')

                    <!-- Title Input -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $note->title) }}" 
                               class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-xl text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-150 @error('title') border-red-500 dark:border-red-500 ring-1 ring-red-500 @enderror"
                               placeholder="Give your note a title..." required autofocus />
                        @error('title')
                            <p class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content Input -->
                    <div class="mb-8">
                        <label for="content" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Content</label>
                        <textarea name="content" id="content" rows="12" 
                                  class="w-full px-4 py-3 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-xl text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-150 @error('content') border-red-500 dark:border-red-500 ring-1 ring-red-500 @enderror"
                                  placeholder="Start writing down your ideas, lists, or thoughts..." required>{{ old('content', $note->content) }}</textarea>
                        @error('content')
                            <p class="mt-2 text-xs font-semibold text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-4 border-t border-gray-100 dark:border-gray-700/60 pt-6">
                        <a href="{{ route('notes.index') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 font-semibold text-sm transition duration-150">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-violet-600 hover:from-indigo-600 hover:to-violet-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 ease-in-out transform hover:-translate-y-0.5 text-sm">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            Update Note
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
