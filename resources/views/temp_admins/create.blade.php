<x-layout>
    <x-slot:heading>
    </x-slot:heading>

    <x-slot:nav>
    </x-slot:nav>

    @section('title', 'Create Admin')

    @section('content')
        <div class="container mx-auto py-6">
            <h1 class="text-3xl font-bold mb-6">Create New Admin</h1>

            <form action="{{ route('temp_admins.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="text-xl">Name</label>
                    <input type="text" name="name" id="name" class=" mt-2 p-2 border border-gray-300 rounded-lg">
                    @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="text-xl">Email</label>
                    <input type="email" name="email" id="email" class=" mt-2 p-2 border border-gray-300 rounded-lg">
                    @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="text-xl">Password</label>
                    <input type="password" name="password" id="password" class=" mt-2 p-2 border border-gray-300 rounded-lg">
                    @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="text-xl">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class=" mt-2 p-2 border border-gray-300 rounded-lg">
                </div>

                <button type="submit" class="rounded-md bg-blue-500 px-4 py-2 text-white mt-3 inline-block">
                    Create Admin
                </button>
                <a href="{{ route('temp_admins.index') }}" class="rounded-md bg-red-500 px-4 py-2 text-white mt-3 inline-block ml-4">
                    Back
                </a>
            </form>
        </div>
    @endsection
</x-layout>
