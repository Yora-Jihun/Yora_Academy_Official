@props(['doc', 'currentPage'])

<div class="w-[280px] bg-white border-l border-[#EAEAEA] flex flex-col h-full hidden xl:flex">
    <div class="px-3 md:px-4 py-3 md:py-4 border-b border-gray-100">
        <h3 class="text-[11px] md:text-[13px] font-semibold text-gray-900 uppercase tracking-wider mb-2 md:mb-3">Page Outline</h3>
        <div class="space-y-0.5 max-h-48 overflow-y-auto">
            @if(isset($currentPage) && $currentPage && $currentPage->content)
                @php
                    $outlineItems = [];
                    if (preg_match_all('/<h[23][^>]*>(.*?)<\/h[23]>/s', $currentPage->content, $matches)) {
                        foreach ($matches[0] as $i => $match) {
                            $level = (int) substr($matches[0][$i], 2, 1);
                            $text = strip_tags($matches[1][$i]);
                            $outlineItems[] = ['level' => $level, 'text' => $text];
                        }
                    }
                @endphp
                @foreach($outlineItems as $item)
                    <a href="#" class="block text-[11px] md:text-[13px] text-gray-600 hover:text-[#5B5FEF] py-0.5 md:py-1 px-{{ $item['level'] === 2 ? '1.5' : '3' }} md:px-{{ $item['level'] === 2 ? '2' : '3' }} rounded-none transition">
                        {{ $item['text'] }}
                    </a>
                @endforeach
            @else
                <p class="text-[11px] md:text-[13px] text-gray-500">No outline available</p>
            @endif
        </div>
    </div>

    <div class="px-3 md:px-4 py-3 md:py-4 space-y-3 md:space-y-4">
        <div>
            <span class="text-[10px] md:text-[11px] text-gray-500 uppercase tracking-wider">Status</span>
            <div class="mt-0.5 md:mt-1">
                <span class="inline-flex items-center px-2 md:px-2.5 py-0.5 md:py-1 text-[11px] md:text-[12px] font-medium bg-green-100 text-green-700 rounded-full">Published</span>
            </div>
        </div>

        <div>
            <span class="text-[10px] md:text-[11px] text-gray-500 uppercase tracking-wider">Visibility</span>
            <div class="mt-0.5 md:mt-1">
                <span class="inline-flex items-center px-2 md:px-2.5 py-0.5 md:py-1 text-[11px] md:text-[12px] font-medium bg-[#F5F6FF] text-[#5B5FEF] rounded-full">Public</span>
            </div>
        </div>

        @if($doc && $doc->user)
            <div class="flex items-center gap-2 md:gap-3">
                <img src="https://placehold.co/32x32/5B5FEF/white?text={{ substr($doc->user->fullname ?? 'A', 0, 1) }}" class="w-7 h-7 md:w-8 md:h-8 rounded-full" alt="Author">
                <div>
                    <p class="text-[11px] md:text-[13px] font-medium text-gray-900">{{ $doc->user->fullname ?? 'Author' }}</p>
                    <p class="text-[10px] md:text-[11px] text-gray-500">Maintainer</p>
                </div>
            </div>
        @endif
    </div>
</div>