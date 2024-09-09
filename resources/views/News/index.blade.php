<x-layout>
    <x-slot:nav>
        <a href="{{ route('news.index') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">
            News
        </a>

        <a href="{{ route('categories.index') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">
            Categories
        </a>
        <a href="{{ route('frontend.categoryList') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" style="margin-left: 840px" aria-current="page">
            Site
        </a>

    </x-slot:nav>

    @section('title', 'news List')

    @section('content')
        <div class="container">


            <a href="{{ route('news.create') }}" class="rounded-md bg-blue-500 px-4 py-2 text-white mb-3 inline-block">Create News Item</a>

            <table class="table-auto w-full mt-5 text-center">
                <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($news as $newsItem)
                <tr>
                    <td class="border px-4 py-2">{{ $newsItem->id }}</td>
                    <td class="border px-4 py-2">{{ $newsItem->title }}</td>
                    <td class="border px-4 py-2">
                        @foreach ($newsItem->categories as $key => $category)
                            <span>{{ $category->name }}@if($key + 1 < $newsItem->categories->count()),@endif</span>
                        @endforeach
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('news.edit', $newsItem->id) }}" class="rounded-md bg-yellow-500 px-4 py-2 text-white">Edit</a>
                        <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-md bg-red-500 px-4 py-2 text-white">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</x-layout>
