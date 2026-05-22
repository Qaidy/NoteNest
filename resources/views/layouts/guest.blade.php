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
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100">
        <div class="min-h-screen flex">
            <!-- Left Side: Branding & Gradient -->
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 items-center justify-center">
                <!-- Soft overlay to make it look premium -->
                <div class="absolute inset-0 bg-white/10 dark:bg-black/10"></div>
                
                <div class="relative z-10 p-12 flex flex-col items-center text-center text-white max-w-lg">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center mb-8 shadow-2xl border border-white/30">
                        <x-application-logo class="w-12 h-12 fill-current text-white" />
                    </div>
                    <h1 class="text-4xl font-bold mb-4 tracking-tight">Capture Your Ideas</h1>
                    <p class="text-lg text-white/90 font-medium">The modern, secure, and beautiful way to organize your thoughts and notes.</p>
                </div>
            </div>

            <!-- Right Side: Form Content -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-24 bg-gray-50 dark:bg-gray-900">
                <div class="w-full max-w-md">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden flex justify-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <x-application-logo class="w-10 h-10 fill-current text-white" />
                        </div>
                    </div>
                    
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
