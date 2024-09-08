<x-layout>
    <x-slot:heading>
    </x-slot:heading>
    <x-slot:nav>
    </x-slot:nav>

    @section('content')
        <div class="container">
            <h1 class="text-2xl font-bold mb-5">News for {{ $category->name }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($newsItems as $news)
                    <div class="bg-white shadow-lg rounded-lg p-5">
                        <h2 class="text-xl font-semibold">{{ $news->title }}</h2>
                        <p class="mt-2">{{ Str::limit($news->content, 20) }}</p>
                        <a href="{{ route('news.show', $news->id) }}" class="rounded-md bg-blue-500 px-4 py-2 text-white mt-3 inline-block">
                            Read More
                        </a>
                    </div>
                @endforeach
            </div>

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
            @endforeach

            <a href="{{ route('frontend.categoryList') }}" class="rounded-md bg-red-500 px-4 py-2 text-white mt-5 inline-block">
                Back to Categories
            </a>
        </div>
    @endsection
</x-layout>
