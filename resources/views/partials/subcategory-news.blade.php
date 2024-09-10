@foreach ($category->children as $subcategory)
    <h2 class="text-2xl font-bold mb-1 mt-6">News for Subcategory {{ $subcategory->name }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($subcategory->news as $news)
            <div class="bg-white shadow-lg rounded-lg p-5">
                <h2 class="text-xl font-semibold">{{ $news->title }}</h2>
                <p class="mt-2">{{ Str::limit($news->content, 20) }}</p>
                <a href="{{ route('news.show', $news->id) }}" class="rounded-md bg-blue-500 px-4 py-2 text-white mt-3 inline-block">
                    Read More
                </a>
            </div>
        @endforeach
    </div>

    @if ($subcategory->children && $subcategory->children->count())
        @include('partials.subcategory-news', ['category' => $subcategory])
    @endif
@endforeach
