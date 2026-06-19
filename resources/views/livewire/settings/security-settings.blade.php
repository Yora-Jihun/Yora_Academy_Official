<main class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Security Settings</h1>
            <p class="text-sm text-gray-500 mt-0.5">Update your password to keep your account secure</p>
        </div>
    </div>

    <div class="bg-white border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Change Password</h3>

        @include('partials.alerts', [
            'type' => 'success',
            'message' => session('status'),
            'class' => 'mb-4',
        ])

        <form wire:submit="submit" class="space-y-4 max-w-md">
            @error('auth')
                @include('partials.alerts', [
                    'type' => 'error',
                    'message' => $message,
                    'class' => 'mb-4',
                ])
            @enderror

            <div>
                <x-password-input
                    name="current_password"
                    label="Current Password"
                    type="password"
                    model="current_password"
                />
            </div>

            <div>
                <x-password-input
                    name="password"
                    label="New Password"
                    type="password"
                    placeholder="At least 8 characters"
                    model="password"
                />
            </div>

            <div>
                <x-password-input
                    name="password_confirmation"
                    label="Confirm New Password"
                    type="password"
                    placeholder="Re-enter new password"
                    model="password_confirmation"
                />
            </div>

            <div class="pt-2">
                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-none hover:bg-blue-700 transition">Update Password</button>
            </div>
        </form>
    </div>

    <div class="bg-white border border-red-200 p-6">
        <h3 class="text-sm font-semibold text-red-700 uppercase tracking-wider mb-2">Danger Zone</h3>
        <p class="text-sm text-gray-500 mb-4">Once you delete your account, all of your data will be permanently removed. This action cannot be undone.</p>

        <form wire:submit="deleteAccount" class="space-y-4 max-w-md">
            @error('auth')
                @include('partials.alerts', [
                    'type' => 'error',
                    'message' => $message,
                    'class' => 'mb-4',
                ])
            @enderror

            <div>
                <x-password-input
                    name="delete_password"
                    label="Confirm your password"
                    type="password"
                    model="delete_password"
                    placeholder="Enter your password"
                />
            </div>

            <div class="pt-2">
                <button type="submit" class="px-5 py-2.5 border border-red-600 text-red-600 text-sm font-medium bg-transparent hover:bg-red-600 hover:text-white transition">Delete Account Permanently</button>
            </div>
        </form>
    </div>

    @script
    <script>
        Livewire.on('notify', (message) => alert(message));
    </script>
    @endscript
</main>
