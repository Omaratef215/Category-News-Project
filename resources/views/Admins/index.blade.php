<x-layout>
    <x-slot:nav>
        <a href="{{ route('news.index') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">
            News
        </a>

        <a href="{{ route('categories.index') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">
            Categories
        </a>
        <a href="{{ route('frontend.categoryList') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" style="margin-left: 650px" aria-current="page">
            Site
        </a>
        <div class="flex items-center justify-between w-full">
            <div class="ml-auto flex items-center space-x-4">
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('categories.index') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">
                        Admin
                    </a>
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

    @section('title', 'Admins')

    @section('content')
        <div class="container">
            <a href="{{ route('Admins.create') }}" class="rounded-md bg-blue-500 px-4 py-2 text-white mb-3 inline-block">Create New Admin</a>

            <table class="table-auto w-full mt-5 text-center">
                <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $admin->id }}</td>
                        <td class="border px-4 py-2">{{ $admin->name }}</td>
                        <td class="border px-4 py-2">{{ $admin->email }}</td>
                        <td class="border px-4 py-2">
                            <div class="flex justify-center space-x-2">
                                <form action="{{ route('Admins.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-md bg-red-500 px-4 py-2 text-white">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</x-layout>
