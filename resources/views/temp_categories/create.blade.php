<x-layout>
    <x-slot:heading>
        Create Categories
    </x-slot:heading>

    <x-slot:nav>
        <a href="{{ route('temp_news.index') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">
            News
        </a>
    </x-slot:nav>

    @section('content')
        <div class="container">
            <form action="{{ route('temp_categories.store') }}" method="POST">
                @csrf
                <div class="form-group mb-4">
                    <label for="name" class="text-1xl font-bold tracking-tight text-gray-900">Category Name : </label>
                    <input type="text" name="name" id="name" class="form-control mt-2" required>
                </div>
                @if ($errors->has('name'))
                    <span class="text-red-500">{{ $errors->first('name') }}</span>
                @endif
                <div class="form-group mb-4">
                    <label for="parent_id" class="text-1xl tracking-tight text-gray-900">Parent Category:</label>
                    <select name="parent_id" id="parent_id" class="form-control mt-2">
                        <option value="">None</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="rounded-md bg-blue-500 px-4 py-2 text-white mb-3 inline-block">Create</button>
                <a href="{{ route('temp_categories.index') }}" class="rounded-md bg-red-500 px-4 py-2 text-white mb-3 inline-block ml-2">Back</a>
            </form>
        </div>
    @endsection
</x-layout>
