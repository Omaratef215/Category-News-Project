<x-layout>
    <x-slot:heading>

    </x-slot:heading>

    <x-slot:nav>

    </x-slot:nav>

    @section('content')
            <div class="container">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-4">
                        <label for="name" class="text-1xl font-bold tracking-tight text-gray-900">Category Name : </label>
                        <input type="text" name="name" id="name" class="form-control mt-2" value="{{ $category->name }}" required>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-red-500">{{ $errors->first('name') }}</span>
                    @endif
                    <div class="form-group mb-4">
                        <label for="parent_id" class="text-1xl tracking-tight text-gray-900">Parent Category:</label>
                        <select name="parent_id" id="parent_id" class="form-control mt-2">
                            <option value="">None</option>
                            @foreach($categories as $parentCategory)
                                @if($parentCategory->id !== $category->id)
                                <option value="{{ $parentCategory->id }}" {{ $category->parent_id == $parentCategory->id ? 'selected' : ''}}>
                                    {{ $parentCategory->name }}
                                </option>
                                @endif;
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="rounded-md bg-blue-500 px-4 py-2 text-white mb-3 inline-block">Update</button>
                    <a href="{{ route('categories.index') }}" class="rounded-md bg-red-500 px-4 py-2 text-white mb-3 inline-block ml-2">Back</a>
                </form>
            </div>
        @endsection
</x-layout>
