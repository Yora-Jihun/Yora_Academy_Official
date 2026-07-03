<div class="p-6">
    <h2 class="text-2xl font-semibold mb-4">Your Documentation</h2>

    @if(empty($docs))
        <p>No docs yet.</p>
        <a href="{{ route('docs') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-[#5B5FEF] text-white">
            <x-icon name="document-plus" class="w-4 h-4" />
            Create new doc
        </a>
    @else
        <ul class="space-y-3">
            @foreach($docs as $doc)
                <li class="p-3 border rounded flex items-center justify-between">
                    <div>
                        <div class="font-medium">{{ $doc['title'] }}</div>
                        <div class="text-sm text-gray-600">{{ $doc['description'] }}</div>
                    </div>
                    <div>
                        <a href="{{ route('docs', ['docId' => $doc['id']]) }}" class="px-3 py-1 bg-gray-200 rounded">Open</a>
                    </div>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('docs') }}" class="mt-6 inline-flex items-center gap-2 px-4 py-2 bg-[#5B5FEF] text-white">
            <x-icon name="document-plus" class="w-4 h-4" />
            Create new doc
        </a>
    @endif
</div>
