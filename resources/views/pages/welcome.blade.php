<x-landing>
    <div class="min-h-screen flex items-center justify-center px-4 py-12 bg-[#FAFAFB]">
        <div class="w-full max-w-5xl grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            <div class="text-center lg:text-left space-y-6">
                <a href="{{ route('welcome') }}" wire:navigate class="inline-flex items-center justify-center gap-3" aria-label="Yora Academy Home">
                    <div class="w-10 h-10 bg-[#5B5FEF] rounded-none flex items-center justify-center shadow-sm">
                        <x-icon name="book-open" class="w-5 h-5 text-white" />
                    </div>
                    <span class="text-[17px] font-semibold text-gray-900">Yora Academy</span>
                </a>

                <div class="space-y-3">
                    <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900">
                        Create and manage beautiful documentation
                    </h1>
                    <p class="text-sm md:text-base leading-relaxed text-gray-500 max-w-lg mx-auto lg:mx-0">
                        A modern documentation platform built with Laravel and Livewire. Create, organize, and share your documentation with the world.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                    <a
                        href="{{ route('docs') }}"
                        wire:navigate
                        class="inline-flex items-center justify-center bg-[#5B5FEF] px-6 md:px-8 py-2.5 md:py-3 text-xs md:text-[14px] font-medium text-white rounded-none transition duration-200 hover:bg-[#4A4DDF] focus:outline-none focus:ring-4 focus:ring-[#5B5FEF]/20"
                    >
                        My Documentation
                    </a>
                    <a
                        href="{{ route('docs.explore') }}"
                        wire:navigate
                        class="inline-flex items-center justify-center border border-gray-200 bg-white px-6 md:px-8 py-2.5 md:py-3 text-xs md:text-[14px] font-medium text-gray-600 rounded-none transition duration-200 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-200"
                    >
                        Explore Public Docs
                    </a>
                </div>
            </div>

            <div class="hidden lg:block">
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-[#5B5FEF]/10 to-gray-100/50 rounded-none blur-2xl"></div>
                    <div class="relative bg-white rounded-none border border-gray-100 shadow-xl p-6 md:p-8 space-y-6">
                        <div class="flex items-center gap-2 px-2 py-1.5 text-xs md:text-[14px] text-gray-500 uppercase tracking-wider">
                            <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                            <span>Documentation Preview</span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center gap-2 px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-[14px] text-gray-800 rounded-none">
                                <x-icon name="chevron-right" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400" />
                                <x-icon name="folder-open" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                                <span>Getting Started</span>
                            </div>

                            <div class="ml-4 md:ml-6 space-y-1">
                                <div class="flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none tree-item active">
                                    <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                    <span>Welcome</span>
                                </div>
                                <div class="flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none tree-item">
                                    <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                    <span>Installation</span>
                                </div>
                                <div class="flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none tree-item">
                                    <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                    <span>Quickstart Guide</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-[14px] text-gray-800 rounded-none tree-item">
                                <x-icon name="chevron-right" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400" />
                                <x-icon name="folder-open" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                                <span>API Reference</span>
                            </div>
                        </div>

                        <div class="h-32 rounded-none bg-gray-50 border border-gray-100 p-3 md:p-4">
                            <h4 class="text-xs md:text-[14px] font-semibold text-gray-900 mb-2">Installation Guide</h4>
                            <p class="text-[11px] md:text-[13px] text-gray-500">
                                Follow the steps below to get started with Yora Academy...
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-landing>