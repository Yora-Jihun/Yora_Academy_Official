<aside id="sidebar" class="w-[250px] fixed left-0 top-0 h-screen bg-white border-r border-[#EAEAEA] flex flex-col z-50 transition-all duration-300 hidden md:flex">
    <div class="px-4 pt-6 pb-4 flex items-center justify-between">
        <a href="{{ route('docs') }}" wire:navigate class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#5B5FEF] rounded-none flex items-center justify-center shadow-sm">
                <x-icon name="book-open" class="w-5 h-5 text-white" />
            </div>
            <span class="text-[17px] font-semibold text-gray-900">Yora Academy</span>
        </a>
        <button id="mobileSidebarClose" class="md:hidden p-2 rounded-none hover:bg-gray-50">
            <x-icon name="x" class="w-5 h-5 text-gray-600" />
        </button>
    </div>

    <nav class="flex-1 px-3 space-y-0.5 overflow-y-auto">
        <a href="{{ route('docs') }}" wire:navigate class="nav-item flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition {{ $active === 'docs' ? 'active' : '' }}">
            <x-icon name="document-text" class="w-5 h-5" />
            <span>My Documentation</span>
        </a>
        <a href="{{ route('docs.explore') }}" wire:navigate class="nav-item flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition {{ $active === 'explore' ? 'active' : '' }}">
            <x-icon name="book-open" class="w-5 h-5" />
            <span>Public Repository</span>
        </a>
        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition">
            <x-icon name="bookmark" class="w-5 h-5" />
            <span>Favorites</span>
        </a>
        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition">
            <x-icon name="clock" class="w-5 h-5" />
            <span>Recent</span>
        </a>
        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition">
            <x-icon name="document-text" class="w-5 h-5" />
            <span>Drafts</span>
        </a>
        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition">
            <x-icon name="code" class="w-5 h-5" />
            <span>Templates</span>
        </a>
        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition">
            <x-icon name="trash" class="w-5 h-5" />
            <span>Trash</span>
        </a>
    </nav>

    <div class="px-3 py-4 space-y-0.5">
        <a href="{{ route('profile-settings') }}" wire:navigate class="nav-item flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition {{ $active === 'profile-settings' ? 'active' : '' }}">
            <x-icon name="settings" class="w-5 h-5" />
            <span>Profile Settings</span>
        </a>
        <a href="{{ route('security-settings') }}" wire:navigate class="nav-item flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition {{ $active === 'security-settings' ? 'active' : '' }}">
            <x-icon name="security" class="w-5 h-5" />
            <span>Security</span>
        </a>
        <a href="#" class="nav-item flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition">
            <x-icon name="help" class="w-5 h-5" />
            <span>Help</span>
        </a>
    </div>

    <div class="px-4 py-4 border-t border-gray-100">
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs text-gray-500 font-medium">Storage Usage</span>
            <span class="text-xs text-gray-400">12GB / 50GB</span>
        </div>
        <div class="h-2 bg-gray-100 rounded-none overflow-hidden">
            <div class="h-full w-[24%] bg-[#5B5FEF] rounded-none"></div>
        </div>
    </div>

    <style>
        .nav-item.active {
            background: #F5F6FF;
            color: #5B5FEF;
            font-weight: 500;
        }
        .nav-item.active svg {
            stroke: #5B5FEF;
        }
    </style>
</aside>

<!-- Mobile Sidebar Overlay -->
<div id="mobileSidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mobileSidebarClose = document.getElementById('mobileSidebarClose');
        const mobileSidebarOverlay = document.getElementById('mobileSidebarOverlay');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');

        function openMobileSidebar() {
            if (sidebar) {
                sidebar.classList.remove('hidden');
                sidebar.style.transform = 'translateX(0)';
            }
            if (mobileSidebarOverlay) mobileSidebarOverlay.classList.remove('hidden');
        }

        function closeMobileSidebar() {
            if (sidebar) {
                sidebar.style.transform = 'translateX(-100%)';
                setTimeout(() => sidebar.classList.add('hidden'), 300);
            }
            if (mobileSidebarOverlay) mobileSidebarOverlay.classList.add('hidden');
        }

        if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openMobileSidebar);
        if (mobileSidebarClose) mobileSidebarClose.addEventListener('click', closeMobileSidebar);
        if (mobileSidebarOverlay) mobileSidebarOverlay.addEventListener('click', closeMobileSidebar);
    });
</script>