<x-layout>
    <x-slot:nav>
        <a href="{{ route('news.index') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">
            News
        </a>

        <a href="{{ route('categories.index') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">
            Categories
        </a>
        <a href="{{ route('frontend.categoryList') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" style="margin-left: 780px" aria-current="page">
            Site
        </a>
        <div class="flex items-center justify-between w-full">
            <div class="ml-auto flex items-center space-x-4">
                @if(Auth::check() && Auth::user()->role === 'admin')
                @endif
                @if(Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-md bg-red-500 px-3 py-2 text-sm font-medium text-white hover:bg-red-600" style="margin-left: 10px">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-md bg-blue-500 px-3 py-2 text-sm font-medium text-white hover:bg-blue-600">
                        Login
                    </a>
                @endif
            </div>
        </div>
    </x-slot:nav>

    @section('title', 'categories')

    @section('content')
        <div class="container">
            <a href="{{ route('categories.create') }}" class="rounded-md bg-blue-500 px-4 py-2 text-white mb-3 inline-block">Create New Category</a>

            <table class="table-auto w-full mt-5 text-center">
                <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                    <th class="px-4 py-2">News</th>
                    <th class="px-4 py-2">Parents</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $category->id }}</td>
                        <td class="border px-4 py-2">{{ $category->name }}</td>
                        <td class="border px-4 py-2">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('categories.edit', $category->id) }}" class="rounded-md bg-yellow-500 px-4 py-2 text-white">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-md bg-red-500 px-4 py-2 text-white">Delete</button>
                                </form>
                            </div>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ route('categories.news', $category->id) }}" class="text-blue-500">View News</a>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            {{ $category->parent ? $category->parent->name : 'None' }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</x-layout>
