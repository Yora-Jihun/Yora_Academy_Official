<div class="sticky top-0 z-30 h-14 md:h-[72px] bg-white border-b border-gray-100 flex items-center justify-between px-4 md:px-6">
    <div class="flex items-center gap-2 md:gap-4">
        <!-- Mobile Menu Button -->
        <button id="mobileMenuBtn" type="button" class="md:hidden p-1.5 md:p-2 rounded-lg bg-gray-50 hover:bg-gray-100 transition" aria-label="Open menu">
            <x-icon name="menu" class="w-4 h-4 md:w-5 md:h-5 text-gray-600" />
        </button>

        <div class="relative">
            <x-icon name="search" class="w-3.5 h-3.5 md:w-5 md:h-5 text-gray-400 absolute left-2.5 md:left-3.5 top-1/2 -translate-y-1/2" />
            <input type="text" placeholder="Search..." class="w-48 sm:w-56 md:w-80 pl-8 md:pl-10 pr-2 md:pr-4 py-1.5 md:py-2.5 text-xs md:text-[14px] text-gray-600 bg-gray-50 border border-gray-100 rounded-xl focus:outline-none focus:border-[#5B5FEF] focus:bg-white transition">
        </div>
    </div>

    <div class="flex items-center gap-1.5 md:gap-3">
        <button type="button" class="p-1.5 md:p-2.5 rounded-xl bg-gray-50 hover:bg-gray-100 transition">
            <x-icon name="bell" class="w-3.5 h-3.5 md:w-5 md:h-5 text-gray-600" />
        </button>

        <button type="button" class="p-1.5 md:p-2.5 rounded-xl bg-gray-50 hover:bg-gray-100 transition hidden sm:block">
            <x-icon name="plus" class="w-3.5 h-3.5 md:w-5 md:h-5 text-gray-600" />
        </button>

        <button type="button" class="px-2.5 md:px-4 py-1 md:py-1.5 md:py-2.5 text-xs md:text-[14px] font-medium text-white bg-[#5B5FEF] rounded-xl hover:bg-[#4A4DDF] transition hidden sm:inline-block">
            Publish
        </button>

        <button type="button" aria-label="Toggle theme" class="p-1.5 md:p-2.5 rounded-xl bg-gray-50 hover:bg-gray-100 transition">
            <x-icon name="theme" class="w-3.5 h-3.5 md:w-5 md:h-5 text-gray-600" />
        </button>

        <div class="w-px h-5 md:h-6 bg-gray-200 hidden sm:block"></div>

        <div class="relative group hidden sm:block">
            <button class="flex items-center gap-1.5 md:gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[13px] text-gray-700 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                <span class="max-w-20 md:max-w-none truncate">My Workspace</span>
                <x-icon name="chevron-down" class="w-3 h-3 md:w-4 md:h-4" />
            </button>
        </div>

        <div class="relative group">
            <div class="w-7 h-7 md:w-9 md:h-9 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center cursor-pointer overflow-hidden ring-2 ring-white shadow-sm">
                <img src="https://placehold.co/36x36/5B5FEF/white?text=U" class="w-full h-full rounded-full object-cover" alt="Avatar">
            </div>

            <div class="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl border border-gray-100 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                <div class="p-4 border-b border-gray-50">
                    <span class="block text-sm font-semibold text-gray-900">User Name</span>
                    <span class="block text-xs text-gray-400 mt-0.5">user@example.com</span>
                </div>
                <div class="p-2 space-y-0.5">
                    <a href="{{ route('profile-settings') }}" wire:navigate class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px] text-gray-700 hover:bg-gray-50 transition">
                        <x-icon name="profile" class="w-4 h-4 text-gray-400" />
                        Profile Settings
                    </a>
                    <a href="{{ route('security-settings') }}" wire:navigate class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px] text-gray-700 hover:bg-gray-50 transition">
                        <x-icon name="security" class="w-4 h-4 text-gray-400" />
                        Security
                    </a>
                    <div class="border-t border-gray-50 my-1"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-[13px] text-red-600 hover:bg-red-50 transition">
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
    });
</script>