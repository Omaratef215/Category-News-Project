<div style="margin-left: {{ $level * 20 }}px;">
    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
           id="category_{{ $category->id }}" class="child-category"
           data-category-id="{{ $category->id }}"
           data-parent-id="{{ $category->parent_id }}"
        {{ isset($news) && $news->categories->contains($category->id) ? 'checked' : '' }}>
    <label for="category_{{ $category->id }}">{{ $category->name }}</label>
</div>

@if ($category->children)
    @foreach ($category->children as $childCategory)
        @include('temp_partials.category-checkbox', ['category' => $childCategory, 'level' => $level + 1])
    @endforeach
@endif
