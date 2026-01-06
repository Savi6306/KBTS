<?php
namespace App\Http\Controllers\Web;
use Illuminate\Support\Str;
use App\Models\KbArticle;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = KbArticle::with('category')->latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'is_published' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['title']).'-'.time();
        $data['is_published'] = $request->has('is_published');

        KbArticle::create($data);

        return redirect()->route('admin.articles.index')->with('success','Article created.');
    }

    public function edit(KbArticle $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article','categories'));
    }

    public function update(Request $request, KbArticle $article)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'is_published' => 'nullable|boolean',
        ]);

        $data['is_published'] = $request->has('is_published');
        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success','Article updated.');
    }

    public function destroy(KbArticle $article)
    {
        $article->delete();
        return back()->with('success','Deleted');
    }
}
