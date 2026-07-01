@props(['active', 'doc'])
<aside class="w-[280px] fixed left-0 top-0 h-screen bg-white border-r border-[#EAEAEA] flex flex-col z-50 transition-all duration-300 hidden md:flex">
    <div class="px-4 pt-6 pb-4 flex items-center justify-between">
        <a href="{{ route('welcome') }}" wire:navigate class="flex items-center gap-3">
            <div class="w-10 h-10 bg-[#5B5FEF] rounded-none flex items-center justify-center shadow-sm">
                <x-icon name="book-open" class="w-5 h-5 text-white" />
            </div>
            <span class="text-[17px] font-semibold text-gray-900">Yora Academy</span>
        </a>
    </div>

    @if(isset($doc) && $doc)
    <nav class="flex-1 px-3 space-y-0.5 overflow-y-auto">
        <div class="px-3 py-2">
            <h3 class="text-xs font-semibold text-gray-900">{{ $doc->title }}</h3>
            @if($doc->description)
            <p class="text-[11px] text-gray-500 mt-1">{{ $doc->description }}</p>
            @endif
        </div>
    </nav>
    @endif

    <div class="px-3 py-4 space-y-0.5">
        @if(auth()->check())
            <a href="{{ route('docs') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition">
                <x-icon name="document-text" class="w-5 h-5" />
                <span>My Documentation</span>
            </a>
        @else
            <a href="{{ route('welcome') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition">
                <x-icon name="home" class="w-5 h-5" />
                <span>Home</span>
            </a>
        @endif
    </div>
</aside>