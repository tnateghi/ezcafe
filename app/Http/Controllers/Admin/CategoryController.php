<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    public $ordering = 1;

    public function index()
    {
        $categories = Category::orderBy('ordering')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
        ]);

        $category = Category::create([
            'title'    => $request->title,
            'slug'     => SlugService::createSlug(Category::class, 'slug', $request->title),
            'ordering' => Category::max('ordering') + 1
        ]);

        return $category;
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title'     => 'required|string',
            'title_two' => 'nullable|string',
            'image'     => 'image|nullable',
            'slug'      => "nullable|unique:categories,slug,$category->id",
        ]);

        $category->update([
            'title'       => $request->title,
            'title_two'   => $request->title_two,
            'slug'        => $request->slug ?: $request->title,
            'description' => $request->description,
            'published'   => $request->has('published'),
        ]);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $name = uniqid() . '_' . $category->id . '.' . $request->image->getClientOriginalExtension();
            $path = $request->image->storeAs('categories', $name);

            $category->image = 'uploads/' . $path;
            $category->save();
        }

        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return $category;
    }

    public function sort(Request $request)
    {
        $this->validate($request, [
            'categories' => 'required|array'
        ]);

        $categories = $request->categories;

        $this->sort_category($categories);

        return 'success';
    }

    private function sort_category($categories, $category_id = null)
    {
        foreach ($categories as $category) {
            Category::find($category['id'])->update(['ordering' => $this->ordering++]);
        }
    }

    public function generate_slug(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $slug = SlugService::createSlug(Category::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }
}
