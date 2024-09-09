<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('temp_categories')->get();
        return view('temp_news.index', compact('news'));
    }



    public function create()
    {
        $categories = Category::with('children')->where('parent_id', null)->get();
        $categories = Category::all();
        return view('temp_news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:60|string|unique:temp_news,title',
            'temp_categories' => 'required|array|min:1',
            'content' => 'required'],[
            'title.unique' => 'The title has already been taken. Please choose a different title.',
            'temp_categories.required' => 'Please select at least one category.',
            'temp_categories.min' => 'Please select at least one category.',
        ]);

            $news = News::create([
            'title' => $request->input('title'),
                'content' => $request->input('content'),
        ]);


        $news->categories()->attach($request->input('temp_categories'));

        return redirect()->route('temp_news.index')->with('success', 'temp_news created successfully.');
    }



    public function edit(News $news)
    {
        $categories = Category::all();
        $selectedCategories = $news->categories->pluck('id')->toArray();
        return view('temp_news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'temp_categories' => 'required|array',
        ]);

        $news->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        $news->categories()->sync($request->input('temp_categories'));

        return redirect()->route('temp_news.index')->with('success', 'temp_news updated successfully.');
    }


    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('temp_news.index');
    }

    public function show($id)
    {
        $news = News::find($id);

        if (!$news) {
            abort(404);
        }

        return view('temp_news.show', compact('news'));
    }
}
