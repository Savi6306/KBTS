<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KbArticle;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminKbController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->category;

        $articles = KbArticle::with('category')
            ->when($category_id, function($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })
            ->latest()
            ->paginate(10);

        $categories = Category::all();

        return view('admin.kb.index', compact('articles','categories','category_id'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.kb.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'is_published'=> 'nullable'
        ]);

        try {
            KbArticle::create([
                'title'       => $request->title,
                'slug'        => $this->generateUniqueSlug($request->title),
                'content'     => $request->content,
                'is_published'=> $request->is_published ? 1 : 0,
                'category_id' => $request->category_id,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('admin.kb.index')->with('success', 'Article created successfully!');
    }

    public function edit(KbArticle $article)
    {
        $categories = Category::all();
        return view('admin.kb.edit', compact('article','categories'));
    }

   // public function update(Request $request, KbArticle $article)
   public function update(Request $request, $id)

    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'is_published'=> 'nullable'
        ]);
$article = KbArticle::findOrFail($id);
        try {
            $article->update([
                'title'       => $request->title,
                'slug'        => $this->generateUniqueSlug($request->title, $article->id),
                'content'     => $request->content,
                'is_published'=> $request->is_published ? 1 : 0,
                'category_id' => $request->category_id,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('admin.kb.index')->with('success', 'Article updated successfully!');
    }

    public function destroy(KbArticle $article)
    {
        $article->delete();
        return back()->with('success', 'Article deleted successfully!');
    }

    private function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (
            KbArticle::where('slug', $slug)
                     ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                     ->exists()
        ) {
            $slug = $original . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
