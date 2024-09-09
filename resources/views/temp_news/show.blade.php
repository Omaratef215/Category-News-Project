<x-layout>
    <x-slot:heading>
    </x-slot:heading>
    <x-slot:nav>
    </x-slot:nav>
    @section('content')
        <div class="container">
            @if($news)
                <h1 class="text-2xl font-bold mb-5">{{ $news->title }}</h1>
                <p class="text-lg">{{ $news->content }}</p>
            @endif
            <a href="{{ route('temp_frontend.categoryList') }}" class="rounded-md bg-red-500 px-4 py-2 text-white mt-3 inline-block">
                Back to categories
            </a>
        </div>
    @endsection
</x-layout>

