<x-layout>
    <x-slot:heading>
    </x-slot:heading>

    <x-slot:nav>
    </x-slot:nav>

    @section('title', 'Edit temp_news Item')

    @section('content')
        <div class="container">
            <form action="{{ route('temp_news.update', $news->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-4">
                    <label for="title" class="text-1xl font-bold tracking-tight text-gray-900">Title:</label>
                    <input type="text" name="title" id="title" class="form-control mt-2"
                           value="{{ old('title', $news->title) }}" required>
                </div>
                @if ($errors->has('title'))
                    <span class="text-red-500">{{ $errors->first('title') }}</span>
                @endif

                <div class="form-group mb-4">
                    <label for="content" class="text-1xl font-bold tracking-tight text-gray-900">Content:</label>
                    <textarea name="content" id="content" rows="1" cols='50' class="form-control mt-2"
                              required>{{ old('content', $news->content) }}</textarea>
                </div>
                @if ($errors->has('content'))
                    <span class="text-red-500">{{ $errors->first('content') }}</span>
                @endif

                <div class="form-group mb-4">
                    <label for="categories" class="text-1xl font-bold tracking-tight text-gray-900">Category:</label>
                    <div class="mt-2">
                        @foreach ($categories as $category)
                            @if(!$category->parent_id)
                                <div>
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                           id="category_{{ $category->id }}" class="parent-category"
                                           @if(in_array($category->id, $news->categories->pluck('id')->toArray())) checked @endif>
                                    <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                                </div>

                                @if ($category->children)
                                    @foreach ($category->children as $child)
                                        @include('temp_partials.category-checkbox', [
                                            'category' => $child,
                                            'level' => 1,
                                            'checked' => in_array($child->id, $news->categories->pluck('id')->toArray())
                                        ])
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>

                @if ($errors->has('temp_categories'))
                    <span class="text-red-500">{{ $errors->first('temp_categories') }}</span>
                @endif

                <button type="submit" class="rounded-md bg-blue-500 px-4 py-2 text-white mb-3 inline-block">Update
                </button>
                <a href="{{ route('temp_news.index') }}"
                   class="rounded-md bg-red-500 px-4 py-2 text-white mb-3 inline-block ml-2">Back</a>
            </form>
        </div>
    @endsection
</x-layout>
