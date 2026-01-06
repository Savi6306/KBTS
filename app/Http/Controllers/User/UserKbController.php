<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KbArticle;
use App\Models\Category;

class UserKbController extends Controller
{
    /**
     * Display Knowledge Base (Helpdesk Style)
     */
    public function index(Request $request)
{
    $search = $request->get('q');
    $category_id = $request->get('category');

    // All categories
    $categories = Category::all();

    // Articles query
    $articles = KbArticle::where('is_published', true)
        ->when($category_id, function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        })
        ->when($search, function ($query) use ($search) {
            $query->where(function ($sub) use ($search) {
                $sub->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
                // अगर content का column body है:
                // ->orWhere('body', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(12);

    // Popular articles
    $popular = KbArticle::where('is_published', true)
        ->orderBy('views', 'desc')
        ->limit(5)
        ->get();

    return view('user.kb.index', compact(
        'categories',
        'articles',
        'popular',
        'search',
        'category_id'
    ));
}

    /**
     * Show Article Details
     */
    public function show($slug)
    {
        $article = KbArticle::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Increase view count
        $article->increment('views');

        // Related articles (same category)
        $related = KbArticle::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->limit(5)
            ->get();

        return view('user.kb.show', compact('article','related'));
    }
    /**
     * ⭐ LIKE / DISLIKE (AJAX)
     */
    public function rate(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:like,dislike',
        ]);

        $article = KbArticle::findOrFail($id);

        if ($request->type == 'like') {
            $article->increment('likes');
        } else {
            $article->increment('dislikes');
        }

        return response()->json([
            'success'   => true,
            'likes'     => $article->likes,
            'dislikes'  => $article->dislikes,
        ]);
    }

}
 