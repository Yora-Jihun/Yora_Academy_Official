@props(['doc', 'currentPage'])

@php
$allPages = $doc->pages ?? collect([]);
foreach ($doc->sections ?? [] as $section) {
    $allPages = $allPages->merge($section->pages ?? []);
}
@endphp

<div class="w-[280px] bg-white border-l border-[#EAEAEA] flex flex-col h-full hidden xl:flex">
    <div class="flex-1 flex flex-col min-h-0">
        <div class="px-3 md:px-4 py-3 md:py-4 border-b border-gray-100">
            <h3 class="text-[11px] md:text-[13px] font-semibold text-gray-500 uppercase tracking-wider mb-2 md:mb-3">Page Outline</h3>
            <div class="space-y-0.5 max-h-48 overflow-y-auto">
                @foreach($allPages as $page)
                <span class="block text-[11px] md:text-[13px] text-gray-600 py-0.5 md:py-1">{{ $page->title }}</span>
                @endforeach
            </div>
        </div>

        <div class="px-3 md:px-4 py-3 md:py-4 space-y-3 md:space-y-4 flex-1">
            <div>
                <span class="text-[10px] md:text-[11px] text-gray-500 uppercase tracking-wider">Status</span>
                <div class="mt-0.5 md:mt-1 flex gap-1.5">
                    @if($doc?->is_public)
                    <span class="inline-flex items-center px-2 md:px-2.5 py-0.5 md:py-1 text-[11px] md:text-[12px] font-medium bg-green-100 text-green-700 rounded-full">Published</span>
                    @else
                    <span class="inline-flex items-center px-2 md:px-2.5 py-0.5 md:py-1 text-[11px] md:text-[12px] font-medium bg-gray-100 text-gray-600 rounded-full">Draft</span>
                    @endif
                    <span class="inline-flex items-center px-2 md:px-2.5 py-0.5 md:py-1 text-[11px] md:text-[12px] font-medium bg-[#F5F6FF] text-[#5B5FEF] rounded-full">{{ $doc?->is_public ? 'Public' : 'Private' }}</span>
                </div>
            </div>

            @if($doc?->user)
            <div>
                <div class="flex items-center gap-2 md:gap-3">
                    <img src="{{ $doc?->user?->avatar ? \Illuminate\Support\Facades\Storage::disk('avatars')->url('avatars/'.$doc->user->avatar) : asset('assets/images/Jerome_Edica.jpg') }}" class="w-7 h-7 md:w-8 md:h-8 rounded-full" alt="Author">
                    <div>
                        <p class="text-[11px] md:text-[13px] font-medium text-gray-900">{{ $doc?->user?->fullname ?? 'Unknown Author' }}</p>
                        <p class="text-[10px] md:text-[11px] text-gray-500">Author</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="px-4 py-2 border-t border-gray-100 flex items-center gap-1.5 md:gap-2 text-[10px] md:text-[12px] text-gray-500">
        <x-icon name="document-text" class="w-3 h-3 md:w-3.5 md:h-3.5" />
        Published · Updated {{ $doc?->updated_at?->diffForHumans() ?? 'just now' }}
    </div>

    @auth
    <div class="px-3 md:px-4 py-3 md:py-4 space-y-2 md:space-y-3">
        <button class="w-full flex items-center justify-center gap-1.5 md:gap-2 px-3 md:px-4 py-1.5 md:py-2.5 text-[11px] md:text-[13px] font-medium text-gray-700 bg-gray-50 rounded-none hover:bg-gray-100 transition">
            <x-icon name="share" class="w-3.5 h-3.5 md:w-4 md:h-4" />
            Share
        </button>

        <div class="relative">
            <select class="w-full appearance-none text-[11px] md:text-[13px] text-gray-700 bg-gray-50 border border-gray-100 rounded-none px-2 md:px-3 py-1 md:py-2 focus:outline-none focus:border-[#5B5FEF] transition pr-8">
                <option>Edit Permissions</option>
                <option>View Only</option>
                <option>Can Edit</option>
                <option>Can Comment</option>
            </select>
            <x-icon name="chevron-down" class="w-3 h-3 md:w-3.5 md:h-3.5 text-gray-400 absolute right-2 md:right-3 top-1/2 -translate-y-1/2 pointer-events-none" />
        </div>
    </div>
    @endauth
</div>