<ul class="list-disc ml-5 mt-2 space-y-2">
    @foreach ($subcategories as $subcategory)
        <li>
            <div class="flex items-center space-x-2">
                <span class="font-medium text-lg">{{ $subcategory->name }}</span>
                <a href="{{ route('category.news', $subcategory->id) }}" class="text-blue-500 underline">
                    Show News
                </a>
            </div>

            @if ($subcategory->children && $subcategory->children->count())
                @include('partials.subcategory', ['subcategories' => $subcategory->children])
            @endif
        </li>
    @endforeach
</ul>
