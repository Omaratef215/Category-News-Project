<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $test = Category::with('children')->where('parent_id' , null)->get();
/*        dd($test);*/
        $categories = Category::all();
        return view('temp_categories.index', compact('categories'));
    }
    public function create()
    {
        $categories = Category::with('children')->where('parent_id', null)->get();
        $categories = Category::all();
        return view('temp_categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:60|string|unique:temp_categories,name',
            'parent_id' => 'nullable|exists:temp_categories,id' ],
         [   'name.unique' => 'The category name has already been taken. Please choose a different name.',
        ]);

        Category::create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
        ]);

        return redirect()->route('temp_categories.index')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|unique:temp_categories,name,' . $category->id ,
            'parent_id' => 'nullable|exists:temp_categories,id',
        ]);

        $category->update([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
        ]);

        return redirect()->route('temp_categories.index')->with('success', 'Category updated successfully.');
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('temp_categories.edit', compact('category', 'categories'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('temp_categories.index')->with('success', 'Category created successfully.');
    }

    public function showNews(Category $category)
    {
        $news = $category->news;
        return view('temp_categories.temp_news', compact('news', 'category'));
    }

    public function showCategoryList()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('temp_frontend.categoryList', compact('categories'));
    }

    public function showCategoryNews($id)
    {

        $category = Category::findOrFail($id);

        $newsItems = $category->news;

        if ($newsItems->isEmpty()) {
            dd("No temp_news items found for category ID: $id");
        }

        return view('temp_frontend.newList', compact('category', 'newsItems'));
    }

}
