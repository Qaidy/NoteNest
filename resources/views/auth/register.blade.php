<x-guest-layout>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700/50 p-8 sm:p-10">
        <div class="mb-8 text-center sm:text-left">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Create an account</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Join NoteNest to start capturing your ideas.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                <x-text-input id="name" class="block w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900/50 focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-shadow duration-200" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                <x-text-input id="email" class="block w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900/50 focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-shadow duration-200" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="john@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                <x-text-input id="password" class="block w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900/50 focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-shadow duration-200"
                                type="password"
                                name="password"
                                required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1" />
                <x-text-input id="password_confirmation" class="block w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900/50 focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-shadow duration-200"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-indigo-500 via-purple-500 to-purple-600 hover:from-indigo-600 hover:via-purple-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 transform hover:-translate-y-0.5">
                    {{ __('Sign up') }}
                </button>
            </div>
            
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Already registered? 
                    <a href="{{ route('login') }}" class="font-medium text-purple-600 dark:text-purple-400 hover:text-purple-500 transition-colors">Sign in</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
