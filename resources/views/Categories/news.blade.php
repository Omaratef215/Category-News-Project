<x-layout>
    <x-slot:heading>
    </x-slot:heading>
    <x-slot:nav>
    </x-slot:nav>
    @section('content')
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">News for {{ $category->name }}</h1>

            <ul class="list-disc pl-5 mb-6">
                @foreach ($news as $newsItem)
                    <li class="mb-2 text-lg text-gray-700">{{ $newsItem->title }}</li>
                @endforeach
            </ul>

            <a href="{{ route('categories.index') }}" class="inline-block rounded-md bg-red-500 px-4 py-2 text-white font-semibold hover:bg-red-600 transition duration-300">Back to Categories</a>
        </div>
    @endsection
</x-layout>
