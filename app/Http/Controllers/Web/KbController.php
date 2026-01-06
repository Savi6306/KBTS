<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\KbArticle;
use Illuminate\Http\Request;

class KbController extends Controller
{
    public function index(Request $request)
    {
        $query = KbArticle::where('is_published', true);

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest()->paginate(10);

        return view('kb.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = KbArticle::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('kb.show', compact('article'));
    }
}
