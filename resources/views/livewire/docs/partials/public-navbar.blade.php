<div class="sticky top-0 z-30 h-14 md:h-[72px] bg-white border-b border-gray-100 flex items-center justify-end px-4 md:px-6">
    <div class="flex items-center gap-1.5 md:gap-3">
        @guest
            <a href="{{ route('login') }}" wire:navigate class="px-2.5 md:px-4 py-1 md:py-1.5 md:py-2.5 text-xs md:text-[14px] font-medium text-gray-600 bg-gray-50 rounded-none hover:bg-gray-100 transition">
                Sign In
            </a>
            <a href="{{ route('register') }}" wire:navigate class="px-2.5 md:px-4 py-1 md:py-1.5 md:py-2.5 text-xs md:text-[14px] font-medium text-white bg-[#5B5FEF] rounded-none hover:bg-[#4A4DDF] transition">
                Sign Up
            </a>
        @endguest

        <button type="button" aria-label="Toggle theme" class="p-1.5 md:p-2.5 rounded-none bg-gray-50 hover:bg-gray-100 transition">
            <x-icon name="theme" class="w-3.5 h-3.5 md:w-5 md:h-5 text-gray-600" />
        </button>
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