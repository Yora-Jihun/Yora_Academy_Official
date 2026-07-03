<div class="sticky top-0 z-30 h-14 md:h-[72px] bg-white border-b border-gray-100 flex items-center justify-between px-4 md:px-6">
    <div class="flex items-center gap-2 md:gap-4">
        <!-- Mobile Menu Button -->
        <button id="mobileMenuBtn" type="button" class="md:hidden p-1.5 md:p-2 rounded-none bg-gray-50 hover:bg-gray-100 transition" aria-label="Open menu">
            <x-icon name="menu" class="w-4 h-4 md:w-5 md:h-5 text-gray-600" />
        </button>

    </div>

    @php $notificationCount = 3; @endphp
    <div class="flex items-center gap-1.5 md:gap-3">
      <button
    type="button"
    aria-label="View notifications"
    class="group relative inline-flex h-10 w-10 items-center justify-center rounded-lg border border-transparent text-gray-500 transition-all duration-200 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900 active:scale-95"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="1.75"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="h-5 w-5 transition-transform duration-200 group-hover:rotate-6"
    >
        <path d="M15 17h5l-1.4-1.4A2 2 0 0 1 18 14.2V11a6 6 0 1 0-12 0v3.2a2 2 0 0 1-.6 1.4L4 17h5" />
        <path d="M9.5 17a2.5 2.5 0 0 0 5 0" />
    </svg>

    @if($notificationCount > 0)
        <span
            class="absolute -right-0.5 -top-0.5 flex h-5 min-w-[20px] items-center justify-center rounded-full bg-rose-500 px-1 text-[10px] font-semibold leading-none text-white ring-2 ring-white"
        >
            {{ $notificationCount > 99 ? '99+' : $notificationCount }}
        </span>
    @endif
</button>

        <button type="button" aria-label="Toggle theme" class="p-1.5 md:p-2.5 rounded-none bg-gray-50 hover:bg-gray-100 transition">
            <x-icon name="theme" class="w-3.5 h-3.5 md:w-5 md:h-5 text-gray-600" />
        </button>

        <div class="w-px h-5 md:h-6 bg-gray-200 hidden sm:block"></div>

        <div class="relative group hidden sm:block">
            <button class="flex items-center gap-1.5 md:gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[13px] text-gray-700 bg-gray-50 rounded-none hover:bg-gray-100 transition">
                <span class="max-w-20 md:max-w-none truncate">My Workspace</span>
                <x-icon name="chevron-down" class="w-3 h-3 md:w-4 md:h-4" />
            </button>
        </div>

        <div class="relative group" id="user-menu-container">
            <div class="w-7 h-7 md:w-9 md:h-9 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center cursor-pointer overflow-hidden ring-2 ring-white shadow-sm">
                <img src="{{ auth()->user()?->avatar ? \Illuminate\Support\Facades\Storage::disk('public')->url('avatars/'.auth()->user()->avatar) : asset('assets/images/Jerome_Edica.jpg') }}" class="w-full h-full rounded-full object-cover" alt="Avatar" id="navbar-avatar">
            </div>

            <div class="absolute right-0 top-full mt-2 w-56 bg-white rounded-none border border-gray-100 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                <div class="p-4 border-b border-gray-50">
                    <span class="block text-sm font-semibold text-gray-900">{{ auth()->user()?->fullname ?? 'User' }}</span>
                    <span class="block text-xs text-gray-400 mt-0.5">{{ auth()->user()?->email ?? 'user@example.com' }}</span>
                </div>
                <div class="p-2 space-y-0.5">
                    <a href="{{ route('profile-settings') }}" wire:navigate class="flex items-center gap-2.5 px-3 py-2 rounded-none text-[13px] text-gray-700 hover:bg-gray-50 transition">
                        <x-icon name="profile" class="w-4 h-4 text-gray-400" />
                        Profile Settings
                    </a>
                    <a href="{{ route('security-settings') }}" wire:navigate class="flex items-center gap-2.5 px-3 py-2 rounded-none text-[13px] text-gray-700 hover:bg-gray-50 transition">
                        <x-icon name="security" class="w-4 h-4 text-gray-400" />
                        Security
                    </a>
                    <div class="border-t border-gray-50 my-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-none text-[13px] text-red-600 hover:bg-red-50 transition">
                            <x-icon name="logout" class="w-4 h-4" />
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.querySelector('[aria-label="Toggle theme"]');
        if (themeToggle) {
            themeToggle.addEventListener('click', function() {
                document.documentElement.classList.toggle('dark');
            });
        }

        Livewire.on('profile-updated', () => {
            window.location.reload();
        });
    });

</script>
