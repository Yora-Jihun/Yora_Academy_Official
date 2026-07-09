<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-[#5B5FEF]">Security Settings</h1>
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
                <button type="submit" wire:loading.attr="disabled" wire:target="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#5B5FEF] text-white text-sm font-medium rounded-none hover:bg-[#4A4DDF] focus:outline-none focus:ring-4 focus:ring-[#5B5FEF]/20 transition disabled:opacity-70 disabled:cursor-not-allowed">
                    <svg wire:loading wire:target="submit" class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="submit">Update Password</span>
                    <span wire:loading wire:target="submit">Updating…</span>
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white border border-red-200 p-6">
        <h3 class="text-sm font-semibold text-red-700 uppercase tracking-wider mb-2">Danger Zone</h3>
        <p class="text-sm text-gray-500 mb-4">Once you delete your account, all of your data will be permanently removed. This action cannot be undone.</p>

        <button type="button" wire:click="openDeleteModal" wire:loading.attr="disabled" wire:target="openDeleteModal" class="px-5 py-2.5 border border-red-600 text-red-600 text-sm font-medium bg-transparent hover:bg-red-600 hover:text-white transition disabled:opacity-70 disabled:cursor-not-allowed">
            Delete Account Permanently
        </button>
    </div>

    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" wire:click="closeDeleteModal" wire:poll.1s="tick">
            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-none shadow-xl w-full max-w-md p-6" wire:click.stop>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Delete Account</h3>
                <p class="text-sm text-gray-500 mb-4">
                    This will permanently delete your account and all associated data. This action cannot be undone.
                </p>

                @if($deleteError)
                    @include('partials.alerts', [
                        'type' => 'error',
                        'message' => $deleteError,
                        'class' => 'mb-4',
                    ])
                @endif

                @if($delete_cooldown > 0)
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Verification Code</label>
                            <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="6" wire:model="delete_otp" class="block w-full border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 outline-none transition duration-200 focus:border-[#5B5FEF] focus:ring-4 focus:ring-[#5B5FEF]/10" placeholder="Enter 6-digit code">
                        </div>
                        <div class="flex justify-end gap-3">
                            <button type="button" wire:click="closeDeleteModal" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition">Cancel</button>
                            <button type="button" wire:click="verifyDeleteOtp" wire:loading.attr="disabled" wire:target="verifyDeleteOtp" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition disabled:opacity-70 disabled:cursor-not-allowed">
                                <svg wire:loading wire:target="verifyDeleteOtp" class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>
                                <span wire:loading.remove wire:target="verifyDeleteOtp">Delete Account</span>
                                <span wire:loading wire:target="verifyDeleteOtp">Deleting…</span>
                            </button>
                        </div>
                        <p class="text-xs text-gray-400 text-center">Resend code in {{ $delete_cooldown }}s</p>
                    </div>
                @else
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Deleting account for</label>
                            <div class="block w-full border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-900">
                                {{ $delete_email }}
                            </div>
                        </div>
                        <div class="flex justify-end gap-3">
                            <button type="button" wire:click="closeDeleteModal" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition">Cancel</button>
                            <button type="button" wire:click="sendDeleteOtp" wire:loading.attr="disabled" wire:target="sendDeleteOtp" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition disabled:opacity-70 disabled:cursor-not-allowed">
                                <svg wire:loading wire:target="sendDeleteOtp" class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                </svg>
                                <span wire:loading.remove wire:target="sendDeleteOtp">Send Verification Code</span>
                                <span wire:loading wire:target="sendDeleteOtp">Sending…</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    @script
    <script>
        Livewire.on('notify', (message) => alert(message));
    </script>
    @endscript
</div>
