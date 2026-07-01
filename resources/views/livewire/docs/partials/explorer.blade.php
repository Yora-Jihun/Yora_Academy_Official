<div class="w-[280px] bg-white border-r border-[#EAEAEA] flex flex-col h-full hidden lg:flex">
    <div class="px-4 py-4 border-b border-gray-100">
        <div class="relative">
            <select class="w-full text-xs md:text-[14px] font-medium text-gray-800 bg-gray-50 border border-gray-100 rounded-none pl-2 md:pl-3 pr-8 py-1.5 md:py-2 focus:outline-none focus:border-[#5B5FEF] transition appearance-none">
                <option>My Workspace</option>
            </select>
            <x-icon name="chevron-down" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400 absolute right-2 md:right-3 top-1/2 -translate-y-1/2 pointer-events-none" />
        </div>
    </div>

    <div class="px-3 md:px-4 py-2 md:py-3 flex items-center gap-1.5 md:gap-2 border-b border-gray-100">
        <button class="flex-1 flex items-center justify-center gap-1 px-2 md:gap-1.5 md:px-3 py-1 md:py-1.5 text-[11px] md:text-[13px] text-gray-600 bg-gray-50 rounded-none hover:bg-gray-100 transition">
            <x-icon name="plus" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            <span class="hidden sm:inline">Add Section</span>
            <span class="sm:hidden">Section</span>
        </button>
        <button class="flex-1 flex items-center justify-center gap-1 px-2 md:gap-1.5 md:px-3 py-1 md:py-1.5 text-[11px] md:text-[13px] text-gray-600 bg-gray-50 rounded-none hover:bg-gray-100 transition">
            <x-icon name="plus" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            <span class="hidden sm:inline">Add Page</span>
            <span class="sm:hidden">Page</span>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-1.5 md:py-2">
        <div class="px-3 md:px-4 space-y-0.5">
            <div class="flex items-center gap-1.5 md:gap-2 px-1.5 md:px-2 py-1 md:py-1.5 text-[11px] md:text-[13px] text-gray-500 uppercase tracking-wider font-medium">
                <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                <span>Documentation</span>
            </div>

            <div class="space-y-0.5 mt-0.5 md:mt-1">
                <div class="flex items-center gap-2 px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-[14px] text-gray-800 rounded-none hover:bg-gray-50 cursor-pointer tree-item active">
                    <x-icon name="chevron-right" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400" />
                    <x-icon name="folder-open" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                    <span>Getting Started</span>
                </div>

                <div class="ml-4 md:ml-6 space-y-0.5">
                    <a href="#" class="flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 tree-item">
                        <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                        <span>Welcome</span>
                    </a>
                    <a href="#" class="flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 tree-item active">
                        <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                        <span>Installation</span>
                    </a>
                    <a href="#" class="flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 tree-item">
                        <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                        <span>Quickstart Guide</span>
                    </a>
                </div>

                <div class="flex items-center gap-2 px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-[14px] text-gray-800 rounded-none hover:bg-gray-50 cursor-pointer tree-item">
                    <x-icon name="chevron-right" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400" />
                    <x-icon name="folder-open" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                    <span>API Reference</span>
                </div>

                <div class="flex items-center gap-2 px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-[14px] text-gray-800 rounded-none hover:bg-gray-50 cursor-pointer tree-item">
                    <x-icon name="chevron-right" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400" />
                    <x-icon name="folder-open" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                    <span>Components</span>
                </div>

                <div class="flex items-center gap-2 px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-[14px] text-gray-800 rounded-none hover:bg-gray-50 cursor-pointer tree-item">
                    <x-icon name="chevron-right" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400" />
                    <x-icon name="folder-open" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                    <span>Examples</span>
                </div>
            </div>
        </div>
    </nav>
</div>