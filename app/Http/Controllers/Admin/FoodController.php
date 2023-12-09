<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::filter()->latest()->paginate(20);

        $draft_foods     = Food::draft()->count();
        $published_foods = Food::published()->count();
        $all_foods       = Food::count();

        return view('admin.foods.index', compact(
            'foods',
            'draft_foods',
            'published_foods',
            'all_foods',
        ));
    }

    public function create()
    {
        $categories = Category::orderBy('title')->get();

        return view('admin.foods.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string',
            'title_two'   => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|integer',
            'content'     => 'nullable|string'
        ]);

        $data['slug']      = $data['title'];
        $data['published'] = $request->published ? true : false;
        $data['instock']   = $request->instock ? true : false;

        $food = Food::create($data);

        $this->updateFoodImages($food, $request);

        notifyMessage('success', 'غذا با موفقیت اضافه شد');

        return response('success');
    }

    public function edit(Food $food)
    {
        $categories = Category::orderBy('title')->get();

        return view('admin.foods.edit', compact('food', 'categories'));
    }

    public function update(Request $request, Food $food)
    {
        $data = $request->validate([
            'title'       => 'required|string',
            'title_two'   => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|integer',
            'content'     => 'nullable|string'
        ]);

        $data['slug']      = $data['title'];
        $data['published'] = $request->published ? true : false;
        $data['instock']   = $request->instock ? true : false;

        $food->update($data);

        $this->updateFoodImages($food, $request);

        notifyMessage('success', 'غذا با موفقیت ویرایش شد');

        return response('success');
    }

    public function destroy(Food $food)
    {
        $food->delete();

        return response('success');
    }

    private function updateFoodImages(Food $food, Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = uniqid() . '_' . $food->id . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/foods', $name, 'public');

            $food->update(['image' => '/uploads/foods/' . $name]);
        }
    }
}
