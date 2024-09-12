<x-layout>
    <x-slot:heading>
    </x-slot:heading>
    <x-slot:nav>
        <div class="flex items-center justify-between w-full">
            <div class="ml-auto flex items-center space-x-4">
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('categories.index') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">
                        Admin
                    </a>
                @endif
                    @if(Auth::check() && Auth::user()->role === 'admin' && Auth::user()->super_role ==='yes')
                        <a href="{{ route('admins.index') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white">Add Admin</a>
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

                        <a href="{{ route('register') }}" class="rounded-md bg-blue-500 px-3 py-2 text-sm font-medium text-white hover:bg-blue-600">
                            Register
                        </a>
                @endif
            </div>
        </div>
    </x-slot:nav>

    @section('content')
        <div class="container mx-auto py-6">
            <h1 class="text-3xl font-bold mb-6">Categories</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($categories as $category)
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-xl font-semibold">{{ $category->name }}</h2>

                        <button onclick="toggleSubcategories({{ $category->id }})" class="rounded-md bg-gray-500 px-4 py-2 text-white mt-3">
                            Show Subcategories
                        </button>

                        <div id="subcategories-{{ $category->id }}" style="display: none;" class="mt-3">
                            @if ($category->children && $category->children->count())

                                @include('partials.subcategory', ['subcategories' => $category->children])
                            @else
                                <p class="text-gray-600 mt-3">No subcategories available.</p>
                            @endif
                        </div>

                        <a href="{{ route('category.news', $category->id) }}" class="rounded-md bg-blue-500 px-4 py-2 text-white mt-3 inline-block">
                            View News
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <script>
            function toggleSubcategories(categoryId) {
                var element = document.getElementById('subcategories-' + categoryId);
                if (element.style.display === 'none') {
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            }
        </script>
    @endsection
</x-layout>
