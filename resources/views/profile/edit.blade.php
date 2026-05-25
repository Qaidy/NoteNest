<x-app-layout>
    <!-- Page Header -->
    <div class="max-w-2xl mx-auto mt-6 mb-8 px-4 sm:px-0">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Settings</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your account</p>
    </div>

    <div class="max-w-2xl mx-auto space-y-6 px-4 sm:px-0 pb-12">
        
        <!-- Profile Info Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700/60 p-6 sm:p-8">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Profile Information</h2>
            
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Username</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                           class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition-all duration-200 shadow-sm @error('name') border-red-500 focus:border-red-500 focus:ring-red-500/30 @enderror">
                    @error('name')
                        <p class="mt-2 text-sm text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                           class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition-all duration-200 shadow-sm @error('email') border-red-500 focus:border-red-500 focus:ring-red-500/30 @enderror">
                    @error('email')
                        <p class="mt-2 text-sm text-red-500 font-medium">{{ $message }}</p>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-3">
                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                Your email address is unverified.
                                <button form="send-verification" class="text-sm text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 font-medium transition-colors">
                                    Click here to re-send the verification email.
                                </button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                                    A new verification link has been sent to your email address.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg px-5 py-2 shadow-sm shadow-emerald-500/20 transition-all duration-200 text-sm">
                        Save Changes
                    </button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                           class="text-sm font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 px-3 py-1 rounded-md">
                            Saved successfully.
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Change Password Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-100 dark:border-gray-700/60 p-6 sm:p-8">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Change Password</h2>
            
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <label for="update_password_current_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Current Password</label>
                    <input type="password" name="current_password" id="update_password_current_password" autocomplete="current-password"
                           class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition-all duration-200 shadow-sm @if($errors->updatePassword->has('current_password')) border-red-500 focus:border-red-500 focus:ring-red-500/30 @endif">
                    @if($errors->updatePassword->has('current_password'))
                        <p class="mt-2 text-sm text-red-500 font-medium">{{ $errors->updatePassword->first('current_password') }}</p>
                    @endif
                </div>

                <div>
                    <label for="update_password_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">New Password</label>
                    <input type="password" name="password" id="update_password_password" autocomplete="new-password"
                           class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition-all duration-200 shadow-sm @if($errors->updatePassword->has('password')) border-red-500 focus:border-red-500 focus:ring-red-500/30 @endif">
                    @if($errors->updatePassword->has('password'))
                        <p class="mt-2 text-sm text-red-500 font-medium">{{ $errors->updatePassword->first('password') }}</p>
                    @endif
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="update_password_password_confirmation" autocomplete="new-password"
                           class="w-full px-4 py-2 border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition-all duration-200 shadow-sm @if($errors->updatePassword->has('password_confirmation')) border-red-500 focus:border-red-500 focus:ring-red-500/30 @endif">
                    @if($errors->updatePassword->has('password_confirmation'))
                        <p class="mt-2 text-sm text-red-500 font-medium">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                    @endif
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg px-5 py-2 shadow-sm shadow-emerald-500/20 transition-all duration-200 text-sm">
                        Update Password
                    </button>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                           class="text-sm font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 px-3 py-1 rounded-md">
                            Password updated.
                        </p>
                    @endif
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
