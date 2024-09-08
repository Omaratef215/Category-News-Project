<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('categories')->get();
        return view('news.index', compact('news'));
    }



    public function create()
    {
        $categories = Category::with('children')->where('parent_id', null)->get();
        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:60|string|unique:news,title',
            'categories' => 'required|array|min:1',
            'content' => 'required'],[
            'title.unique' => 'The title has already been taken. Please choose a different title.',
            'categories.required' => 'Please select at least one category.',
            'categories.min' => 'Please select at least one category.',
        ]);

            $news = News::create([
            'title' => $request->input('title'),
                'content' => $request->input('content'),
        ]);


        $news->categories()->attach($request->input('categories'));

        return redirect()->route('news.index')->with('success', 'News created successfully.');
    }



    public function edit(News $news)
    {
        $categories = Category::all();
        $selectedCategories = $news->categories->pluck('id')->toArray();
        return view('news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categories' => 'required|array',
        ]);

        $news->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        $news->categories()->sync($request->input('categories'));

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }


    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index');
    }

    public function show($id)
    {
        $news = News::find($id);

        if (!$news) {
            abort(404);
        }

        return view('news.show', compact('news'));
    }
}
