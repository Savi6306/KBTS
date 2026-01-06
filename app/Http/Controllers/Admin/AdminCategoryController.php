<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    // LIST + SEARCH + FILTER
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $categories = Category::query()
            ->when($search, fn($q) => $q->where('name','like',"%$search%"))
            ->when($status, fn($q) => $q->where('status',$status))
            ->latest()
            ->paginate(10);

        return view('admin.categories.index', compact('categories','search','status'));
    }

    // CREATE PAGE
    public function create()
    {
        return view('admin.categories.create');
    }

    // STORE NEW CATEGORY
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'icon'        => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status'      => 'required|in:Active,Inactive'
        ]);

        Category::create([
            'name'        => $request->name,
            'slug'        => $this->uniqueSlug($request->name),
            'icon'        => $request->icon,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success','Category created successfully');
    }
public function show(Category $category)
{
    $category->loadCount('articles');
    return view('admin.categories.show', compact('category'));
}


    // EDIT PAGE
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // UPDATE CATEGORY (slug not changed)
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'icon'        => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'status'      => 'required|in:Active,Inactive'
        ]);

        $category->update([
            'name'        => $request->name,
            'icon'        => $request->icon,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success','Category updated successfully');
    }

 

    // DELETE
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('success','Category deleted');
    }

    // UNIQUE SLUG GENERATOR
    private function uniqueSlug($name)
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;

        while (Category::where('slug',$slug)->exists()) {
            $slug = $original.'-'.$count;
            $count++;
        }

        return $slug;
    }
}
